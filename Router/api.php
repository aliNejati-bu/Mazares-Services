<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/app/{packagename}/config/{configName}/values/{valueName}", function ($packagename, $configName, $valueName) {
    return (new \MazaresServeces\App\Controller\Client\GetValueController())->getValue($packagename,$configName,$valueName);
});

