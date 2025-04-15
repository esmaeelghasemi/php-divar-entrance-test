<?php

namespace App\Core\Abstracts;

/**
 * Command design pattern
 */
abstract class Service
{
    /**
     * Execute logic
     * @return void
     */
    abstract public function execute(): void;
}