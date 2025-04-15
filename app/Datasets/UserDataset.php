<?php

namespace App\Datasets;

use App\Core\Abstracts\Dataset;
use App\Core\Abstracts\Model;
use App\Models\User;
use Exception;

class UserDataset extends Dataset
{
    private array $users = [];

    /**
     * Implement do add to add item in data
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    protected function doAdd(Model $model): bool
    {
        if(!$model instanceof User) {

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
        if(!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        if (empty($objectIndex = $this->findObjectIndex($model))) {

            return false;
        }

        unset($this->users[$objectIndex]);
        return true;
    }

    /**
     * Implement do select to select item from data
     * @param array $data
     * @return Model|null
     */
    protected function doSelect(array $data): ?User
    {
        if (count($this->users) === 0) {

            return null;
        }

        foreach ($this->users as $user) {

            $select = null;
            foreach ($data as $key => $value) {

                $select = $user->{$key} === $value ? $user : null;
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
        if(!$model instanceof User) {

            throw new Exception("model should be instance of user model");
        }

        $findIndex = array_search($model, $this->users);
        return !empty($findIndex) ? $findIndex : false;
    }
}