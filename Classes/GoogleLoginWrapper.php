<?php

namespace MazaresServices\Classes;

use Google_Client;
use Google_Service_Oauth2;

class GoogleLoginWrapper
{

    /**
     * @var ?GoogleLoginWrapper
     */
    private static ?GoogleLoginWrapper $instance = null;

    /**
     * @var string
     */
    private string $clientID;

    /**
     * @var string
     */
    private string $clientSecret;

    /**
     * @var string
     */
    private string $redirectUri;

    private Google_Client $client;

    /**
     * @param Config $config
     */
    public function __construct(private Config $config)
    {
        $clientID = $this->config->getAllConfig("googleApi")["cid"];
        $clientSecret = $this->config->getAllConfig("googleApi")["cs"];
        $redirectUri = $this->config->getAllConfig("app")["app_url"] . $this->config->getAllConfig("googleApi")["rdu"];
        $this->client = new Google_Client();

        $this->client->setClientId($clientID);
        $this->client->setClientSecret($clientSecret);
        $this->client->setRedirectUri($redirectUri);
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }


    /**
     * @param $code
     * @return bool|array
     */
    public function getEmailAndName($code): bool|array
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);

        if (isset($token["error"])) {
            return false;
        }

        $this->client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($this->client);
        $google_account_info = $google_oauth->userinfo->get();
        return [
            "name" => $google_account_info->name,
            "email" => $google_account_info->email
        ];
    }


    public function getLoginUrl(): string
    {
        return $this->client->createAuthUrl();
    }


    /**
     * @return static
     */
    public static function getInstance(): static
    {
        if (is_null(self::$instance)) {
            self::$instance = new GoogleLoginWrapper(Config::getInstance());
        }
        return self::$instance;
    }

}