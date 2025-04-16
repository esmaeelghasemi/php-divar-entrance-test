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
     * Implement delete advertise
     * @param Model $model
     * @return bool
     */
    protected function doDelete(Model $model): bool
    {
        return $this->dataset->remove($model);
    }

    /**
     * Implement update advertise
     * @param Model $model
     * @param array $data
     * @return Model|null
     */
    protected function dpUpdate(Model $model, array $data): ?Model
    {
        return $this->dataset->update($model, $data);
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