<?php

use MazaresServices\App\Controller\Admin\UserController;
use MazaresServices\App\Controller\App\AppController;
use MazaresServices\App\Controller\App\Config\ConfigController;
use MazaresServices\App\Controller\IndexController;
use Phroute\Phroute\RouteCollector;
use MazaresServices\App\Controller\PanelController;

/**
 * @var RouteCollector $router
 */


$router->controller(route("index"), IndexController::class);


$router->group(["before" => ["authMiddleware"], "prefix" => route("panel")], function (RouteCollector $router) {
    $router->get("/", function () {
        return (new PanelController)->index();
    });
    $router->controller("/user", UserController::class
    );

    $router->get("/apps", function () {
        return (new AppController())->index();
    });

    $router->post("/apps", function () {
        return (new AppController())->doCreateApp();
    });

    $router->get("/apps/panel/{param}", function (string $param) {
        return redirect(route("configApp", $param));
    });

    $router->get("/apps/panel/{param}/configs", function (string $param) {
        return (new AppController())->config($param);
    });

    $router->get("/apps/panel", function () {
        return (new AppController())->panelMenu();
    });


    $router->post("/apps/panel/configs", function () {
        return (new ConfigController)->doCreateConfig();
    });

    $router->get("/apps/panel/{param1}/configs/{param2}", function ($param1, $param2) {
        return (new ConfigController())->configPage($param1, $param2);
    });

    $router->post("/apps/panel/configs/values", function () {
        return (new ConfigController())->createValue();
    });


    $router->post("/apps/panel/configs/values/edit", function () {
        return (new ConfigController())->editValue();
    });

    $router->post("/apps/panel/configs/values/delete", function () {
        return (new ConfigController())->deleteValue();
    });

    $router->post("/apps/panel/configs/edit",function (){
            return (new ConfigController())->editConfig();
    });

    $router->post("/apps/panel/configs/delete",function (){
            return (new ConfigController())->deleteConfig();
    });

});
