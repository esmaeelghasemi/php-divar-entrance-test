<?php

namespace App\Core\Abstracts;

use App\Core\Traits\StaticInstancable;

abstract class Mapper
{
    use StaticInstancable;

    /**
     * @param Dataset $dataset
     */
    public function __construct(
        protected Dataset $dataset
    )
    {
    }

    /**
     * Insert data to dataset via mapper
     * @param Model $model
     * @return Model|null
     * @throws \Exception
     */
    public function insert(Model $model): ?Model
    {
        return $this->doInsert($model);
    }

    /**
     * Delete item from data
     * @param Model $model
     * @return bool
     * @throws \Exception
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
     * @throws \Exception
     */
    public function update(Model $model, array $data): ?Model
    {
        return $this->dpUpdate($model, $data);
    }

    /**
     * Implement insert advertise
     * @param Model $model
     * @return Model|null
     * @throws \Exception
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
     * @throws \Exception
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
     * @throws \Exception
     */
    protected function dpUpdate(Model $model, array $data): ?Model
    {
        return $this->dataset->update($model, $data);
    }

}