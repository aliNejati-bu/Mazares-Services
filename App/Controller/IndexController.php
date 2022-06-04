<?php

namespace MazaresServeces\App\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use MazaresServeces\App\Model\User;
use MazaresServeces\Classes\Auth;
use MazaresServeces\Classes\Exception\ValidatorNotFoundException;
use MazaresServeces\Classes\Redirect;
use MazaresServeces\Classes\Request;
use MazaresServeces\Classes\ViewEngine;

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


}