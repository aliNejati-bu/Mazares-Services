<?php

namespace MazaresServices\App\Controller\App;

use MazaresServices\Classes\Exception\ValidatorNotFoundException;
use MazaresServices\Classes\Redirect;
use MazaresServices\Classes\ViewEngine;

class AppController
{
    public function index(): ViewEngine
    {
        $title = "apps";
        $apps = auth()->userModel->apps;
        return view('panel>User>App>index', compact("title", "apps"));
    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function doCreateApp(): Redirect
    {
        request()->validatePostsAndFiles("createAppValidator");
        if (!preg_match("/^[a-z][a-z0-9_]*(\.[a-z0-9_]+)+[0-9a-z_]$/i", request()->getValidated()["packagename"]))
            return \redirect(back())->with("error", "packagename only allows a-z, 0-9, _ and dot.");
        try {
            $result = auth()->userModel->apps()->create(request()->getValidated());
            if (!$result) {
                return \redirect(back())->with("error", "database Error.");
            }
            return \redirect(back())->withMessage("message", "App Created!.");
        } catch (\Exception $exception) {
            return \redirect(back())->with("error", "database Error.");
        }

    }

    /**
     * @param string $packageName
     * @return ViewEngine
     */
    public function config(string $packageName): ViewEngine
    {
        $packageName = str_replace("-", ".", $packageName);
        $app = auth()->userModel->apps()->where("packagename", "=", $packageName)->first();
        $packagenames = auth()->userModel->apps()->get(["packagename"]);
        if (!$app) {
            return view("err>404");
        }
        $title = $app->app_name . " App Configs";

        return view("panel>User>App>Panel>index", compact("app", "title", "packagenames"));

    }

    /**
     * @return Redirect
     */
    public function panelMenu(): Redirect
    {
        $packagename = auth()->userModel->apps()->first(["packagename"]);
        if (!$packagename) {
            return \redirect(route("apps"))->with("error", "There is no app. Please create one.");
        }
        $packagename = $packagename->packagename;
        $packagename = str_replace(".","-",$packagename);
        return \redirect(route("appPanel", $packagename));
    }
}