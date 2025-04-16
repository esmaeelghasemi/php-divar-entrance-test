<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Datasets\UserDataset;
use App\Models\User;

class UserMapper extends Mapper
{
    /**
     * @param UserDataset $dataset
     */
    public function __construct(
        protected UserDataset $dataset
    ){}

    /**
     * implement do insert to insert data
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
     * implement delete item from data
     * @param Model $model
     * @return bool
     */
    protected function doDelete(Model $model): bool
    {
        return $this->dataset->remove($model);
    }

    /**
     * Implement update item in data
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
     * @param string $username
     * @return Model|null
     */
    public function findByUsername(string $username): ?User
    {
        return $this->dataset->select(['username' => $username]);
    }
}