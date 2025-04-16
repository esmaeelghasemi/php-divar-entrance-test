<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Abstracts\Model;
use App\Core\Traits\ShouldSingleton;
use App\Models\Advertise;
use Exception;

class AdvertiseDataset extends Dataset
{
    use ShouldSingleton;

    private array $advertises = [];

    /**
     * Add data to advertises
     * @throws Exception
     */
    protected function doAdd(Model $model): bool
    {
        if(!$model instanceof Advertise) {

            throw new Exception("model should be instance of advertise model");
        }

        $this->advertises[] = $model;
        return true;
    }

    /**
     * Remove data from advertises
     * @throws Exception
     */
    protected function doRemove(Model $model): bool
    {
        if(!$model instanceof Advertise) {

            throw new Exception("model should be instance of advertise model");
        }

        if (empty($objectIndex = $this->findObjectIndex($model))) {

            return false;
        }

        unset($this->advertises[$objectIndex]);
        return true;
    }


    /**
     * Update data
     * @param Model $model
     * @param array $data
     * @return Model|null
     * @throws Exception
     */
    protected function doUpdate(Model $model, array $data): ?Model
    {
        if (!$model instanceof Advertise) {

            throw new Exception("model should be instance of advertise model");
        }

        if (!is_numeric($objectIndex = $this->findObjectIndex($model))) {

            return null;
        }

        if (empty($object = $this->advertises[$objectIndex])) {

            return null;
        }

        foreach ($data as $key => $value) {

            $object->{$key} = $value;
        }

        $this->advertises[$objectIndex] = $object;

        return $object;
    }


    /**
     * Select advertise
     * @param array $data
     * @return Model|null
     */
    protected function doSelect(array $data): ?Advertise
    {
        if (count($this->advertises) === 0) {

            return null;
        }

        foreach ($this->advertises as $advertise) {

            $select = null;
            foreach ($data as $key => $value) {

                $select = $advertise->{$key} === $value ? $advertise : null;
            }

            if (!is_null($select)) {

                return $select;
            }
        }

        return null;
    }

    /**
     * find object item index by model from data
     * @param Model $model
     * @return int|null
     * @throws Exception
     */
    private function findObjectIndex(Model $model): ?int
    {
        if(!$model instanceof Advertise) {

            throw new Exception("model should be instance of advertise model");
        }

        $findIndex = array_search($model, $this->advertises);
        return !empty($findIndex) ? $findIndex : false;
    }
}