<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Datasets\UserDataset;

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
     * find user by username
     * @param string $username
     * @return Model|null
     */
    public function findByUsername(string $username): ?Model
    {
        return $this->dataset->select(['username' => $username]);
    }
}