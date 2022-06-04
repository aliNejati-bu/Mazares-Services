<?php

namespace MazaresServices\App\Controller\Client;

use JetBrains\PhpStorm\ArrayShape;
use MazaresServices\App\Model\App;
use MazaresServices\App\Model\Config;
use MazaresServices\App\Model\GetValue;

class GetValueController
{

    /**
     * @param $packagename
     * @param $configName
     * @return array|void
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function getAllConfigValue($packagename, $configName)
    {
        $packagename = str_replace("-", ".", $packagename);
        /**
         * @var null|App $app
         */
        $app = App::query()->where("packagename", $packagename)->first();
        if (!$app) {
            http_response_code(404);
            return responseJson(false, [], "App Not Exists.");
        }

        /**
         * @var null|Config $config
         */
        $config = $app->configs()->where("config_name", $configName)->first();
        if (!$config) {
            http_response_code(404);
            return responseJson(false, [], "Config Not Exists.");
        }

        $values = [];
        foreach ($config->values as $value){
            $values[$value->name] = $value->value;
        }

        return responseJson(true,["Value Got."],$values);
    }



    /**
     * @param $packageName
     * @param $configName
     * @param $valueName
     * @return array
     */
    #[ArrayShape(["status" => "bool", "messages" => "array", "data" => "mixed"])] public function getValue($packageName, $configName, $valueName): array
    {
        $packageName = str_replace("-", ".", $packageName);
        /**
         * @var null|App $app
         */
        $app = App::query()->where("packagename", $packageName)->first();
        if (!$app) {
            http_response_code(404);
            return responseJson(false, [], "App Not Exists.");
        }

        /**
         * @var null|Config $config
         */
        $config = $app->configs()->where("config_name", $configName)->first();
        if (!$config) {
            http_response_code(404);
            return responseJson(false, [], "Config Not Exists.");
        }

        $value = $config->values()->where("name", $valueName)->first();
        if (!$value) {
            http_response_code(404);
            return responseJson(false, [], "Value Not Exists.");
        }
        GetValue::query()->create(
            [
                "app_id" => $app->id,
                "config_id" => $config->id,
                "value_id" => $value->id,
                "getter_ip" => request()->ip()
            ]
        );
        return responseJson(true, [], $value->value);
    }
}