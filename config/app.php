<?php


return [
    'lang' => 'fa',
    'app_url' => 'http://localhost:8000',
    'routes' => [
        'index' => '/',
        'signup' => "/sign-up",
        'login' => '/login',
        'panel' => '/panel',
        'userList' => '/panel/user',
        'apiAddPhone' => "/api/add-phone",
        'apiSendVerifyPhone' => '/api/send-verify-code',
        'apiVerifyPhoneCode' => "/api/verify-phone",
        'verifyPhone' => '/panel/verify-phone',

        // user routes.
        'addSlug' => '/panel/slug',
        'addLink' => '/panel/slug/link'
    ],
];