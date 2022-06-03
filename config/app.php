<?php


return [
    'lang' => 'en',
    'app_url' => 'http://localhost:8000',
    'routes' => [
        'index' => '/',
        'signup' => "/sign-up",
        'login' => '/login',
        'panel' => '/dash',
        'userList' => '/dash/user',

        // user Routes
        'apps' => '/dash/apps',
        'firstAppPanel' => '/dash/apps/panel',
        'appPanel' => '/dash/apps/panel/!-!',
        'configApp' => '/dash/apps/panel/!-!/configs',
        'appAddConfig' => '/dash/apps/panel/configs',
        'configValues' => '/dash/apps/panel/!-!/configs/!-!',
        'addConfigValue' => '/dash/apps/panel/configs/values',

        // api
        'apiGetConfigValue' => '/api/app/!-!/config/!-!/values/!-!'
    ],
];