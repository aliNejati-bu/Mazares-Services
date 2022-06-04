<?php

return [
    // add middleware to kernel
    'middleware' => [
        'exampleMiddleware' => \MazaresServices\App\Middleware\ExampleMiddleware::class,
        'authMiddleware' => \MazaresServices\App\Middleware\AuthMiddleware::class,
        'apiAuthMiddleware' => \MazaresServices\App\Middleware\ApiAuthMiddleware::class,
        'onlyVerifyPhone' => \MazaresServices\App\Middleware\OnlyVerifyPhoneMiddleware::class,
    ]
];
