<?php

use Phroute\Phroute\RouteCollector;
use PTC\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \PTC\App\Controller\IndexController::class);



$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \PTC\App\Controller\Admin\UserController::class
    );


});
