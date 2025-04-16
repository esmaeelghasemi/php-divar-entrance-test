<?php

namespace App\Core\Abstracts;

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
     * @param bool $multiple
     * @return array|Model|null
     */
    public function select(array $data, bool $multiple = false): array|Model|null
    {
        return $this->doSelect($data, $multiple);
    }


    abstract protected function doAdd(Model $model): bool;

    abstract protected function doRemove(Model $model): bool;

    abstract protected function doSelect(array $data, bool $isMultiple = false): array|Model|null;

    abstract protected function doUpdate(Model $model, array $data): ?Model;

    /**
     * Prepare to get item field value by key
     * @param Model $model
     * @param string $key
     * @return mixed|null
     */
    protected function getItemFieldValueByKey(Model $model, string $key): mixed
    {
        $val = null;
        $parseKey = explode('.', $key);
        foreach ($parseKey as $part) {

            $val = !is_null($val) ? $val->$part : $model->$part;
        }

        return $val;
    }
}
