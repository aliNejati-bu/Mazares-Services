<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get(route: "/app/{packagename}/config/{configName}/values/{valueName}", handler: function ($packagename, $configName, $valueName) {
    return (new \MazaresServices\App\Controller\Client\GetValueController())->getValue($packagename, $configName, $valueName);
});


$router->get(route: "/app/{packagename}/config/{configName}", handler: function ($packagename, $configName) {
    return (new \MazaresServices\App\Controller\Client\GetValueController())->getAllConfigValue(
        packagename: $packagename,
        configName: $configName
    );
});



