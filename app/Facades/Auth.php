<?php

namespace App\Facades;

use App\Controllers\AuthController;
use App\Core\Abstracts\Facade;

/**
 * @method static string register(string $username)
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AuthController::class;
    }
}