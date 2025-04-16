<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Traits\ShouldSingleton;
use App\Models\User;

class UserDataset extends Dataset
{
    use ShouldSingleton;

    protected array $users = [];

    /**
     * return belong model
     * @return string
     */
    protected function model(): string
    {
        return User::class;
    }

    /**
     * return data name
     * @return string
     */
    protected function dataName(): string
    {
        return 'users';
    }
}