<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Traits\ShouldSingleton;
use App\Models\Advertise;

class AdvertiseDataset extends Dataset
{
    use ShouldSingleton;

    protected array $advertises = [];

    /**
     * Return belong model
     * @return string
     */
    protected function model(): string
    {
        return Advertise::class;
    }

    /**
     * return data name
     * @return string
     */
    protected function dataName(): string
    {
        return 'advertises';
    }
}