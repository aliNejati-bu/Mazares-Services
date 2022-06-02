<?php

namespace PTC\App\Controller;

use PTC\Classes\Redirect;
use PTC\Classes\ViewEngine;

class PanelController
{

    /**
     * @return ViewEngine|Redirect
     */
    public function index(): ViewEngine|Redirect
    {
        if (!auth()->userModel->isPhoneVerify()) {
            return redirect(route("verifyPhone"));
        }
        $currentPage = "panel";
        return view("panel>panel", compact("currentPage"));
    }
}