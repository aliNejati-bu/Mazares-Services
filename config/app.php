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
        'logout' => '/logout',

        // user Routes
        'apps' => '/dash/apps',
        'editApps' => '/dash/apps/edit',
        'deleteApps' => '/dash/apps/delete',
        'firstAppPanel' => '/dash/apps/panel',
        'appPanel' => '/dash/apps/panel/!-!',
        'configApp' => '/dash/apps/panel/!-!/configs',
        'appAddConfig' => '/dash/apps/panel/configs',
        'configValues' => '/dash/apps/panel/!-!/configs/!-!',
        'addConfigValue' => '/dash/apps/panel/configs/values',
        'editConfigValue' => '/dash/apps/panel/configs/values/edit',
        'deleteConfigValue' => '/dash/apps/panel/configs/values/delete',
        'editConfig' => '/dash/apps/panel/configs/edit',
        'deleteConfig' => '/dash/apps/panel/configs/delete',

        // api
        'apiGetConfigValue' => '/api/app/!-!/config/!-!/values/!-!',
        'apiGetConfig' => '/api/app/!-!/config/!-!',
    ],
];