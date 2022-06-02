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

    $router->get("/apps", function () {
        return (new \MazaresServeces\App\Controller\App\AppController())->index();
    });

    $router->post("/apps", function () {
        return (new \MazaresServeces\App\Controller\App\AppController())->doCreateApp();
    });

    $router->get("/apps/panel/{param}", function (string $param) {
        return (new \MazaresServeces\App\Controller\App\AppController())->panel($param);
    });


    $router->post("/apps/panel/configs", function () {
        return (new \MazaresServeces\App\Controller\App\Config\ConfigController)->doCreateConfig();
    });
});
