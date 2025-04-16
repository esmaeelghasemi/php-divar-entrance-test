<?php

namespace App\Facades;

use App\Controllers\AdvertiseController;
use App\Core\Abstracts\Facade;

/**
 * @method static string add(string $username, string $title)
 * @method static string remove(string $username, string $title)
 */
class Advertise extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdvertiseController::class;
    }
}