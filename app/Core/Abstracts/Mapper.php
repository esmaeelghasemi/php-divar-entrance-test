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

    abstract protected function doInsert(Model $model): ?Model;

}