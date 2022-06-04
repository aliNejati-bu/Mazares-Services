<?php

namespace MazaresServices\App\Controller;

use MazaresServices\Classes\Redirect;
use MazaresServices\Classes\ViewEngine;

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