<?php

namespace MazaresServices\Boot\Interfaces;

interface MiddlewareInterface
{
    /**
     * @return mixed|null
     */
    public function run();
}