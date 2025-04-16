<?php

namespace App\Core\Abstracts;

use App\Models\User;
use Exception;

abstract class Dataset
{
    /**
     * Add data
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    public function add(Model $model): bool
    {
        return $this->doAdd($model);
    }

    /**
     * Remove an item from data
     * @param Model $model
     * @return bool
     * @throws Exception
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
     * @throws Exception
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


    /**
     * @throws Exception
     */
    protected function doAdd(Model $model): bool
    {
        $this->assetInstance($model, $this->model());

        $this->{$this->dataName()}[] = $model;
        return true;
    }

    /**
     * @throws Exception
     */
    protected function doRemove(Model $model): bool
    {
        $this->assetInstance($model, $this->model());

        if (!is_numeric($objectIndex = $this->findObjectIndex($model))) {

            return false;
        }

        unset($this->{$this->dataName()}[$objectIndex]);
        return true;
    }

    /**
     * @param array $data
     * @param bool $isMultiple
     * @return array|Model|null
     */
    protected function doSelect(array $data, bool $isMultiple = false): array|Model|null
    {
        $selected = [];

        if (count($this->getData()) === 0) {

            return $isMultiple ? [] : null;
        }

        foreach ($this->getData() as $item) {

            $select = null;
            foreach ($data as $key => $value) {

                $select = $this->getItemFieldValueByKey($item, $key) === $value ? $item : null;
            }

            if (!is_null($select)) {

                $selected[] = $select;
            }
        }

        return $isMultiple ? $selected : (!empty($selected[0]) ? $selected[0] : null);
    }

    /**
     * @throws Exception
     */
    protected function doUpdate(Model $model, array $data): ?Model
    {
        $this->assetInstance($model, $this->model());

        if (!is_numeric($objectIndex = $this->findObjectIndex($model))) {

            return null;
        }

        if (!is_numeric($object = $this->{$this->dataName()}[$objectIndex])) {

            return null;
        }

        foreach ($data as $key => $value) {

            $object->{$key} = $value;
        }

        $this->{$this->dataName()}[$objectIndex] = $object;

        return $object;
    }

    abstract protected function model(): string;

    abstract protected function dataName(): string;

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

    /**
     * find object item index by model from data
     * @param Model $model
     * @return int|null
     * @throws Exception
     */
    private function findObjectIndex(Model $model): ?int
    {
        $findIndex = array_search($model, $this->getData());
        return !empty($findIndex) ? $findIndex : false;
    }

    /**
     * asset instance
     * @throws Exception
     */
    private function assetInstance(Model $model, string $expect): void
    {
        if (!$model instanceof $expect) {

            throw new Exception("model should be instance of {$expect}");
        }
    }

    /**
     * get data
     * @return array
     */
    protected function getData(): array
    {
        return $this->{$this->dataName()};
    }
}
