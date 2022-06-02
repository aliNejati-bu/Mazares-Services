<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \MazaresServeces\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \MazaresServeces\App\Middleware\AuthMiddleware::class,
        'apiAuthMiddleware' => \MazaresServeces\App\Middleware\ApiAuthMiddleware::class,
        'onlyVerifyPhone' => \MazaresServeces\App\Middleware\OnlyVerifyPhoneMiddleware::class,
    ]
];
