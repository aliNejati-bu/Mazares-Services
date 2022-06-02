<?php

namespace MazaresServeces\Boot\Interfaces;

interface MiddlewareInterface
{
    /**
     * @return mixed|null
     */
    public function run();
}