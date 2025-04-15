<?php

namespace App\Helpers;

use App\Core\Abstracts\Service;

class Helper
{
    public static function invokeService(Service $service): Service
    {
        $service->execute();
        return $service;
    }
}