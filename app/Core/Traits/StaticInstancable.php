<?php

namespace App\Core\Traits;

trait StaticInstancable
{
    /**
     * Create instance of object statically
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }
}