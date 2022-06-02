<?php

namespace MazaresServeces\App\Controller\Admin;

use MazaresServeces\App\Model\User;
use MazaresServeces\Classes\Exception\ViewNotFoundedException;
use MazaresServeces\Classes\ViewEngine;

class UserController
{
    /**
     * @throws ViewNotFoundedException
     */
    public function __construct()
    {
        if (!(auth()->userModel->isSuperAdmin() || auth()->userModel->hasPermission("Users"))) {
            $result = view(get404ViewName())->render();
            http_response_code(404);
            echo $result;
            die();
        }
    }

    /**
     * @return ViewEngine
     */
    public function getIndex(): ViewEngine
    {
        $users = User::all();
        return view("panel>user>index",compact("users"));
    }
}