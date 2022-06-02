<?php

namespace MazaresServeces\App\Controller\App\Config;

use MazaresServeces\App\Model\App;
use MazaresServeces\Classes\Exception\ValidatorNotFoundException;
use MazaresServeces\Classes\Redirect;

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
            return \redirect(back())->withMessage("ok","Config Created!");
        } catch (\Throwable $exception) {

            return \redirect(back())->with("error", "DataBase Error.");

        }
    }
}