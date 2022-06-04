<?php

namespace MazaresServices\App\Controller\Admin;

use MazaresServices\App\Model\User;
use MazaresServices\Classes\Exception\ViewNotFoundedException;
use MazaresServices\Classes\ViewEngine;

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