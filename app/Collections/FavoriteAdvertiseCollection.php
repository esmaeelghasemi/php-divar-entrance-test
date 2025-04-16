<?php

namespace App\Collections;

use App\Core\Abstracts\Collection;

class FavoriteAdvertiseCollection extends Collection
{

    /**
     * Make string from data
     * @param array|null $data
     * @return string
     */
    protected function makeString(?array $data = []): string
    {
        return "{$this->data->advertise->title}";
    }
}