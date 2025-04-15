<?php

namespace App\Core\Abstracts;

use Exception;

abstract class Facade
{
    /**
     * @throws Exception
     */
    protected static function getFacadeAccessor()
    {
        throw new Exception("Facade access not implemented");
    }

    /**
     * @throws Exception
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $class = static::getFacadeAccessor();

        return (new $class())->$name(...$arguments);
    }
}