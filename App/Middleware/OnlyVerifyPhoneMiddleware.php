<?php

namespace MazaresServices\App\Middleware;

use MazaresServices\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run(): void
    {
        if (!auth()->userModel->isPhoneVerify()) {
            redirect(route("verifyPhone"))->exec();
        }
    }
}