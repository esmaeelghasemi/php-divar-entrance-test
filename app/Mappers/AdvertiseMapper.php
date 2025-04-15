<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Datasets\AdvertiseDataset;
use App\Models\Advertise;

class AdvertiseMapper extends Mapper
{
    /**
     * @param AdvertiseDataset $dataset
     */
    public function __construct(
        protected AdvertiseDataset $dataset
    )
    {
    }

    /**
     * Implement insert advertise
     * @param Model $model
     * @return Model|null
     */
    protected function doInsert(Model $model): ?Model
    {
        if(empty($this->dataset->add($model))) {

            return null;
        }

        return $model;
    }

    /**
     * find user by username
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): ?Advertise
    {
        return $this->dataset->select(['title' => $title]);
    }
}