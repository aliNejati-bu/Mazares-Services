<?php

namespace MazaresServeces\App\Controller\App;

use MazaresServeces\App\Model\App;
use MazaresServeces\Classes\Exception\ValidatorNotFoundException;
use MazaresServeces\Classes\Redirect;
use MazaresServeces\Classes\ViewEngine;

class AppController
{
    public function index(): ViewEngine
    {
        $title = "apps";
        $apps = auth()->userModel->apps;
        return view('panel>User>App>index', compact("title","apps"));
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

}