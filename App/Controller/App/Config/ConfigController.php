<?php

namespace MazaresServeces\App\Controller\App\Config;

use MazaresServeces\App\Model\App;
use MazaresServeces\App\Model\Config;
use MazaresServeces\App\Model\Value;
use MazaresServeces\Classes\Exception\ValidatorNotFoundException;
use MazaresServeces\Classes\Redirect;
use MazaresServeces\Classes\ViewEngine;

class ConfigController
{

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function doCreateConfig(): Redirect
    {
        request()->validatePostsAndFiles("createConfigValidator");
        /**
         * @var  App|null $app
         */
        try {
            $app = auth()->userModel->apps()->where("id", request()->getValidated()["app_id"])->first();
            if (!$app) {
                return \redirect(back())->with("error", "App Not Exists.");
            }

            if ($app->configs()->where("config_name", request()->getValidated()["config_name"])->first(["id"])) {
                return \redirect(back())->with("error", "Config Name Already Exists.");
            }

            $result = $app->configs()->create(request()->getValidated());
            if (!$result) {
                return \redirect(back())->with("error", "DataBase Error.");
            }
            return \redirect(back())->withMessage("ok", "Config Created!");
        } catch (\Throwable $exception) {

            return \redirect(back())->with("error", "DataBase Error.");

        }
    }


    public function configPage($packageName, $configName): ViewEngine
    {
        $packageName = str_replace("-", ".", $packageName);
        /**
         * @var null|App $app
         */
        $app = auth()->userModel->apps()->where("packagename", "=", $packageName)->first();
        if (!$app) {
            return view("err>404");
        }
        $config = $app->configs()->where("config_name", $configName)->first();
        if (!$config) {
            return view("err>404");
        }
        $title = $config->config_name . " Config Manager";
        return view("panel>User>App>Panel>ConfigValues>index", compact("config", "title"));
    }


    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function createValue(): Redirect
    {
        request()->validatePostsAndFiles("createValueValidator");
        try {
            /**
             * @var null|App $app
             */
            $app = auth()->userModel->apps()->where('id', request()->getValidated()["app_id"])->first();
            if (!$app) {
                return \redirect(back())->with("error", "Game Not Exists.");
            }
            /**
             * @var null|Config
             */
            $config = $app->configs()->where("id", request()->getValidated()["app_id"])->first();
            if ($config->values()->where("name", request()->getValidated()["name"])->first(["id"])) {
                return \redirect(back())->with('err', 'Value Name Exists Before.');
            }
            $result = $config->values()->create(request()->getValidated());
            if (!$result) {
                return \redirect(back())->with("error", "DataBase Error.");
            }
            return \redirect(back())->withMessage("m", "Value Created.");
        } catch (\Throwable $exception) {
            return \redirect(back())->with("error", "DataBase Error.");
        }
    }


    public function editConfig()
    {

    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function editValue(): Redirect
    {
        request()->validatePostsAndFiles("editValueValidator");

        /**
         * @var null|Value $value
         */
        $value = Value::query()->where("id", request()->getValidated()["value_id"])->first();
        if (!$value) {
            return \redirect(back())->with("err", "Value Not Exists.");
        }

        /**
         * @var App $app
         */
        $app = $value->app;

        $foundAppInUser = auth()->userModel->apps()->where("id", $app->id)->first();
        if (!$foundAppInUser) {
            return \redirect(back())->with("err", "Value Not Exists.");
        }


        try {
            $value->name = request()->getValidated()["name"];
            $value->value = request()->getValidated()["value"];
            $value->save();
            return \redirect(back())->withMessage("msg", "Update Successful");
        } catch (\Exception $exception) {
            return \redirect(back())->with("err", "Failed To Update.");
        }
    }

}