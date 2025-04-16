<?php

namespace App\Facades;

use App\Controllers\FavoriteAdvertiseController;
use App\Core\Abstracts\Facade;

/**
 * @method static string add(string $username, string $title)
 * @method static string remove(string $username, string $title)
 * @method static string myFavorites(string $username)
 */
class FavoriteAdvertise extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FavoriteAdvertiseController::class;
    }
}