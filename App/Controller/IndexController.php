<?php

namespace MazaresServices\App\Controller;

use MazaresServices\App\Model\User;
use MazaresServices\Classes\Auth;
use MazaresServices\Classes\Exception\ValidatorNotFoundException;
use MazaresServices\Classes\GoogleLoginWrapper;
use MazaresServices\Classes\Redirect;
use MazaresServices\Classes\Request;
use MazaresServices\Classes\ViewEngine;

class IndexController
{
    public function getIndex(): ViewEngine
    {
        var_dump($_SESSION);
        die();
        return view("index", compact("name"));
    }

    public function getSignUp(): ViewEngine
    {
        $title = "signUp";
        return view("auth>signUp", compact("title"));
    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function postSignUp(): Redirect
    {
        Request::getInstance()->validatePostsAndFiles("signUpValidator");

        $user = User::create(request()->getValidated());
        if ($user) {
            return redirect(route('login'))->withMessage("login", "signUp successful.");
        }
        return redirect(back())->with("error", "Registration failed.");

        // TODO:: برسی فعال بودن تیک قوانین ما
    }

    /**
     * @return ViewEngine
     */
    public function getLogin(): ViewEngine
    {
        $title = "Login";
        return view("auth>login", compact("title"));
    }


    /**
     * @throws ValidatorNotFoundException
     */
    public function postLogin()
    {
        request()->validatePostsAndFiles("auth" . DIRECTORY_SEPARATOR . "loginValidator");
        $auth = new Auth();
        $loginStatus = $auth->doLogin(
            Request::getInstance()->getValidated()["email"],
            Request::getInstance()->getValidated()["password"],
            Request::getInstance()->getValidated()["isLong"] == "1"
        );
        if (!$loginStatus) {
            return redirect(back())->with("error", "Email And Password Not Match.");
        }
        return redirect(route("panel"))->withMessage('message', "Login successful.");
    }


    public function getLoginWithGoogle(): Redirect
    {
        $result = GoogleLoginWrapper::getInstance()->getEmailAndName(\request()->allGet()["code"]);
        if ($result === false) {
            return \redirect(route("login"))->with("error", "Login failed.");
        }

        $auth = new Auth();

        $createSessionResult = $auth->googleLogin($result["email"], $result["name"]);
        if (!$createSessionResult){
            return \redirect(route("login"))->with("error", "Login failed.");
        }
        return \redirect(route("panel"));
    }

}