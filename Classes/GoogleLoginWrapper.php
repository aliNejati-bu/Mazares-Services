<?php

namespace MazaresServices\Classes;

use Google_Client;

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