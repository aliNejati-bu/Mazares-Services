<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \PTC\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \PTC\App\Middleware\AuthMiddleware::class,
        'apiAuthMiddleware' => \PTC\App\Middleware\ApiAuthMiddleware::class,
        'onlyVerifyPhone' => \PTC\App\Middleware\OnlyVerifyPhoneMiddleware::class,
    ]
];
