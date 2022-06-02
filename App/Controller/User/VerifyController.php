<?php

namespace PTC\App\Controller\User;

use Illuminate\Database\QueryException;
use JetBrains\PhpStorm\ArrayShape;
use PTC\Classes\Config;
use PTC\Classes\Exception\ValidatorNotFoundException;
use PTC\Classes\Redirect;
use PTC\Classes\Request;
use PTC\Classes\SMS\SMSManager;
use PTC\Classes\ViewEngine;

class VerifyController
{

    /**
     * @return array
     * @throws ValidatorNotFoundException
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function editPhoneNumber(): array
    {
        Request::getInstance()->validatePostsAndFiles('addPhoneNumberValidator');
        $phoneNumber = Request::getInstance()->getValidated()['phone_number'];
        try {
            auth()->userModel->is_phone_verified = false;
            auth()->userModel->phone = $phoneNumber;
            $result = auth()->userModel->save();
            auth()->userModel->phoneCodes()->update([
                'is_available' => false
            ]);
        } catch (QueryException $exception) {
            http_response_code(409);
            return responseJson(false, [], "phone exists.");
        }
        if (!$result) {
            http_response_code(404);
            return responseJson(false, [], "user not Fonded");
        }
        return responseJson(true, [], "phoneNumberEdited");
    }

    /**
     * @return array
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function generateVerifyCode(): array
    {
        if (!auth()->userModel->phone) {
            http_response_code(400);
            return responseJson(false, [], "user not a phone number.");
        }
        $code = auth()->userModel->phoneCodes->where("created_at", ">", date("Y-m-d H:i:s", time() - 120))->first();
        if ($code) {
            http_response_code(400);
            return responseJson(false, [], "code created before.");
        }
        $code = getActiveCode(6);
        while (auth()->userModel->phoneCodes->where("code", $code)->first()) {
            $code = getActiveCode(6);
        }

        $pushResult = auth()->userModel->phoneCodes()->create([
            "code" => $code,
            "expire_at" => date("Y-m-d H:i:s", time() + 600)
        ]);

        if (!$pushResult) {
            http_response_code(500);
            return responseJson(false, [], "can not add code to database.");
        }

        $result = SMSManager::getInstance()->getSender()->sendCode($code, auth()->userModel->phone);

        if (!$result) {
            auth()->userModel->phoneCodes()->where("code", $code)->first()->delete();
            http_response_code(400);
            return responseJson(false, [], "sms not sent.");
        }

        return responseJson(true, [], "code sent.");
    }


    /**
     * @return array
     * @throws ValidatorNotFoundException
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function verifyActiveCode(): array
    {
        Request::getInstance()->validatePostsAndFiles('verifyPhoneNumber');

        $result = auth()->userModel->phoneCodes()->where("code", Request::getInstance()->getValidated()["code"])->where("expire_at", ">", date("Y-m-d H:i:s", time()))->where("is_available", true)->first();
        if (!$result) {
            http_response_code(400);
            return responseJson(false, [], "Invalid verification code.");
        }

        auth()->userModel->is_phone_verified = true;
        auth()->userModel->save();
        return responseJson(true, [], "phone verified.");
    }


    /**
     * @return Redirect|ViewEngine
     */
    public function verifyCodeView(): Redirect|ViewEngine
    {
        if (auth()->userModel->isPhoneVerify()) {
            return redirect(route("panel"));
        }
        $appUrl = Config::getInstance()->getAllConfig("app")["app_url"];
        $title = "تایید شماره موبایل";
        return view("auth>verifyPhone", compact("title", "appUrl"));
    }

}