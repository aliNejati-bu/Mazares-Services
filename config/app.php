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
        'appPanel' => '/dash/apps/panel/!-!',
        'appAddConfig' => '/dash/apps/panel/configs',

    ],
];