<?php

namespace RemoteConfig\App\Controller\Game;

use RemoteConfig\Classes\ViewEngine;

class GameController
{
    public function index():ViewEngine
    {
        return view('panel>User>Game>index');
    }
}