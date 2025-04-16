<?php

namespace App\Core\Abstracts;

use App\Core\Traits\StaticInstancable;

abstract class Mapper
{
    use StaticInstancable;

    /**
     * Insert data to dataset via mapper
     * @param Model $model
     * @return Model|null
     */
    public function insert(Model $model): ?Model
    {
        return $this->doInsert($model);
    }

    /**
     * Delete item from data
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        return $this->doDelete($model);
    }

    /**
     * Update item in data
     * @param Model $model
     * @param array $data
     * @return Model|null
     */
    public function update(Model $model, array $data): ?Model
    {
        return $this->dpUpdate($model, $data);
    }

    abstract protected function doInsert(Model $model): ?Model;
    abstract protected function doDelete(Model $model): bool;
    abstract protected function dpUpdate(Model $model, array $data): ?Model;

}