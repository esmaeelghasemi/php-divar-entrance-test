<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Abstracts\Model;
use App\Core\Traits\ShouldSingleton;
use App\Models\User;
use Exception;

class UserDataset extends Dataset
{
    use ShouldSingleton;

    private array $users = [];

    /**
     * Implement do add to add item in data
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    protected function doAdd(Model $model): bool
    {
        if (!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        $this->users[] = $model;
        return true;
    }

    /**
     * Implement do remove to remove item from data
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    protected function doRemove(Model $model): bool
    {
        if (!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        if (!is_numeric($objectIndex = $this->findObjectIndex($model))) {

            return false;
        }

        unset($this->users[$objectIndex]);
        return true;
    }

    /**
     * Implement do select to select item from data
     * @param array $data
     * @param bool $isMultiple
     * @return array|User|null
     */
    protected function doSelect(array $data, bool $isMultiple = false): array|User|null
    {
        $selected = [];

        if (count($this->users) === 0) {

            return null;
        }

        foreach ($this->users as $user) {

            $select = null;
            foreach ($data as $key => $value) {

                $select = $user->{$key} === $value ? $user : null;
            }

            if (!is_null($select)) {

                $selected[] = $select;
            }
        }

        return $isMultiple ? $selected : (!empty($selected[0]) ? $selected[0] : null);
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
        if (!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        if (!is_numeric($objectIndex = $this->findObjectIndex($model))) {

            return null;
        }

        if (empty($object = $this->users[$objectIndex])) {

            return null;
        }

        foreach ($data as $key => $value) {

            $object->{$key} = $value;
        }

        $this->users[$objectIndex] = $object;

        return $object;
    }

    /**
     * find object item index by model from data
     * @param Model $model
     * @return int|null
     * @throws Exception
     */
    private function findObjectIndex(Model $model): ?int
    {
        if (!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        $findIndex = array_search($model, $this->users);
        return !empty($findIndex) ? $findIndex : false;
    }
}