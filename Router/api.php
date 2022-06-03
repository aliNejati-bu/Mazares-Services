<?php

use Phroute\Phroute\RouteCollector;

/**
 * @var RouteCollector $router
 */

$router->get("/api/app/{packagename}/config/{configName}/values/{ValueName}", function ($packageName, $configName, $valueName) {

});

