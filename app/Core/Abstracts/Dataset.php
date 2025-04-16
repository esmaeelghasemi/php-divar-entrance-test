<?php

namespace App\Core\Abstracts;

use App\Core\Traits\ShouldSingleton;

abstract class Dataset
{
    /**
     * Add data
     * @param Model $model
     * @return bool
     */
    public function add(Model $model): bool
    {
        return $this->doAdd($model);
    }

    /**
     * Remove an item from data
     * @param Model $model
     * @return bool
     */
    public function remove(Model $model): bool
    {
        return $this->doRemove($model);
    }

    /**
     * Update an item from data
     * @param Model $model
     * @param array $data
     * @return Model|null
     */
    public function update(Model $model, array $data): ?Model
    {
        return $this->doUpdate($model, $data);
    }

    /**
     * Select and return a value from data
     * @param array $data
     * @return Model|null
     */
    public function select(array $data): ?Model
    {
        return $this->doSelect($data);
    }

    abstract protected function doAdd(Model $model): bool;
    abstract protected function doRemove(Model $model): bool;
    abstract protected function doSelect(array $data): ?Model;
    abstract protected function doUpdate(Model $model, array $data): ?Model;
}