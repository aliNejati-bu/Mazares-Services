<?php

use Phroute\Phroute\RouteCollector;
use MazaresServeces\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), \MazaresServeces\App\Controller\IndexController::class);


$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", \MazaresServeces\App\Controller\Admin\UserController::class
    );

    $router->get("/games", function () {
        return (new \MazaresServeces\App\Controller\Game\GameController())->index();
    });

    $router->post("/games", function () {
        return (new \MazaresServeces\App\Controller\Game\GameController())->doCreateGame();
    });
});
