<?php

namespace App\Core\Traits;


trait ShouldSingleton
{
    private static $instance;

    /**
     * Create instance if object not instanced for singletone
     * @return static
     */
    public static function instance(): static
    {
        if (is_null(self::$instance)) {

            self::$instance = new static();
        }

        return self::$instance;
    }
}