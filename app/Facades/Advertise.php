<?php

namespace App\Facades;

use App\Controllers\AdvertiseController;
use App\Core\Abstracts\Facade;

/**
 * @method static string add(string $username, string $title, ?string $tag = null)
 * @method static string remove(string $username, string $title)
 * @method static string myAdvertises(string $username, ?string $tag = null)
 */
class Advertise extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AdvertiseController::class;
    }
}