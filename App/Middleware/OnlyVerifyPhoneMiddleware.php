<?php

namespace PTC\App\Middleware;

use PTC\Boot\Interfaces\MiddlewareInterface;

class OnlyVerifyPhoneMiddleware implements MiddlewareInterface
{
    public function run(): void
    {
        if (!auth()->userModel->isPhoneVerify()) {
            redirect(route("verifyPhone"))->exec();
        }
    }
}