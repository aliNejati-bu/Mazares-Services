<?php

namespace MazaresServices\Classes;

use Firebase\JWT\JWT;
use MazaresServices\App\Model\User;
use MazaresServices\App\Model\UserSessionActivity;

class Auth
{
    /**
     * @var User|null
     */
    public ?User $userModel = null;


    /**
     * @var Auth|null
     */
    public static ?Auth $auth = null;

    /**
     * @param string $email
     * @param string $password
     * @param bool $isLong
     * @return bool
     */
    public function doLogin(string $email, string $password, bool $isLong = false): bool
    {
        $user = User::getUserByEmailAndPassword($email, $password);
        if (!$user) {
            return false;
        }
        $authConfig = Config::getInstance()->getAllConfig("auth");
        try {
            $key = $authConfig["jwt_key"];
            $iat = time();
            if ($isLong) {
                $exp = $iat + $authConfig["token_life_time_in_long"];
            } else {
                $exp = $iat + $authConfig["token_life_time"];
            }
            $payload = [
                'iat' => $iat,
                'exp' => $exp,
                'id' => $user->id
            ];
            $token = JWT::encode($payload, $key, $authConfig["jwt_alg"]);

            $_SESSION[$authConfig["access_token_session_name"]] = $token;

            $session = UserSessionActivity::create(
                ["user_id" => $user->id, "token" => $token]
            );
            $_SESSION[$authConfig["id_session_name"]] = $session->id;
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $userId
     * @return Auth
     */
    public function createUSer($userId): static
    {
        $user = User::find($userId);
        $this->userModel = $user;
        self::$auth = $this;
        return $this;
    }

    /**
     * @return Auth|null
     */
    public static function getInstance(): ?Auth
    {
        return self::$auth;
    }

    public function googleLogin(string $email, string $name)
    {
        try {
            /**
             * @var User $user
             */
            $user = User::query()->where("user_email", $email)->first();
            if (!$user) {
                /**
                 * @var User $user
                 */
                $user = User::query()->create([
                    "user_email" => $email,
                    "name" => $name
                ]);
            }
            $token = $this->createToken($user, true);
            $authConfig = Config::getInstance()->getAllConfig("auth");
            $_SESSION[$authConfig["access_token_session_name"]] = $token;

            $session = UserSessionActivity::create(
                ["user_id" => $user->id, "token" => $token]
            );
            $_SESSION[$authConfig["id_session_name"]] = $session->id;
            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }


    /**
     * @param User $user
     * @param bool $isLong
     * @return string
     */
    private function createToken(User $user, bool $isLong = true): string
    {
        $authConfig = Config::getInstance()->getAllConfig("auth");

        $key = $authConfig["jwt_key"];

        $iat = time();
        if ($isLong) {
            $exp = $iat + $authConfig["token_life_time_in_long"];
        } else {
            $exp = $iat + $authConfig["token_life_time"];
        }
        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'id' => $user->id
        ];

        return JWT::encode($payload, $key, $authConfig["jwt_alg"]);
    }

}