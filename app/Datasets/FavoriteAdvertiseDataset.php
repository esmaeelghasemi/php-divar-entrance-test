<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Traits\ShouldSingleton;
use App\Models\FavoriteAdvertise;

class FavoriteAdvertiseDataset extends Dataset
{
    use ShouldSingleton;

    protected array $favoriteAdvertises = [];

    /**
     * return belong model
     * @return string
     */
    protected function model(): string
    {
        return FavoriteAdvertise::class;
    }

    /**
     * return data name
     * @return string
     */
    protected function dataName(): string
    {
        return 'favoriteAdvertises';
    }
}