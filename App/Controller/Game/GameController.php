<?php

namespace RemoteConfig\App\Controller\Game;

use RemoteConfig\Classes\ViewEngine;

class GameController
{
    public function index():ViewEngine
    {
        $title = "games";
        return view('panel>User>Game>index',compact("title"));
    }
}