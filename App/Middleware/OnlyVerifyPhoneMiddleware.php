<?php

namespace MazaresServeces\App\Middleware;

use MazaresServeces\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run(): void
    {
        if (!auth()->userModel->isPhoneVerify()) {
            redirect(route("verifyPhone"))->exec();
        }
    }
}