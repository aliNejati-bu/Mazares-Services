<?php

namespace MazaresServeces\App\Controller;

use MazaresServeces\Classes\Redirect;
use MazaresServeces\Classes\ViewEngine;

class PanelController
{

    /**
     * @return ViewEngine|Redirect
     */
    public function index(): ViewEngine|Redirect
    {
        $currentPage = "panel";
        return view("panel>panel", compact("currentPage"));
    }
}