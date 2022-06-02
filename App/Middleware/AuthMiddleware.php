<?php

namespace MazaresServeces\App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use MazaresServeces\Classes\Auth;
use MazaresServeces\Classes\Config;
use MazaresServeces\Classes\Request;

class AuthMiddleware implements \MazaresServeces\Boot\Interfaces\MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        $configs = Config::getInstance()->getAllConfig('auth');
        if (!isset($_SESSION[$configs['access_token_session_name']])) {
            redirect(route('login'))->with('error', 'برای درسترسی به پنل باید وارد شده باشد.')->exec();
        }
        try {
            $token = $_SESSION[$configs['access_token_session_name']];
            $payLoad = JWT::decode($token,new Key($configs["jwt_key"],$configs["jwt_alg"]));
            Request::getInstance()->auth = (new Auth())->createUSer($payLoad->id);
        } catch (\Throwable $e) {
            redirect(route('login'))->with('error', 'برای درسترسی به پنل باید وارد شده باشد.')->exec();
        }
    }
}