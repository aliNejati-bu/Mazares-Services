<?php

namespace MazaresServeces\App\Controller\Game;

use MazaresServeces\Classes\Exception\ValidatorNotFoundException;
use MazaresServeces\Classes\Redirect;
use MazaresServeces\Classes\ViewEngine;

class GameController
{
    public function index(): ViewEngine
    {
        $title = "games";
        return view('panel>User>Game>index', compact("title"));
    }

    /**
     * @return Redirect
     * @throws ValidatorNotFoundException
     */
    public function doCreateGame(): Redirect
    {
        request()->validatePostsAndFiles("createGameValidator");
        if (!preg_match("/^[a-z][a-z0-9_]*(\.[a-z0-9_]+)+[0-9a-z_]$/i",request()->getValidated()["packagename"]))
            return \redirect(back())->with("error","packagename only allows a-z, 0-9, _ and dot.");
        try {
            $result = auth()->userModel->games()->create(request()->getValidated());
            if (!$result) {
                return \redirect(back())->with("error", "database Error.");
            }
            return \redirect(back())->withMessage("message", "Game Created!.");
        } catch (\Exception $exception) {
            return \redirect(back())->with("error", "database Error.");
        }

    }

}