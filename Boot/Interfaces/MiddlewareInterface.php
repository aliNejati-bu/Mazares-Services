<?php

namespace PTC\Boot\Interfaces;

interface MiddlewareInterface
{
    /**
     * @return mixed|null
     */
    public function run();
}