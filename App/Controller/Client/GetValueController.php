<?php

namespace MazaresServeces\App\Controller\Client;

use MazaresServeces\App\Model\App;
use MazaresServeces\App\Model\Config;
use MazaresServeces\App\Model\GetValue;

class GetValueController
{
    public function getValue($packageName, $configName, $valueName)
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