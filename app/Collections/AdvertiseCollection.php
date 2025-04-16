<?php

namespace App\Collections;

use App\Core\Abstracts\Collection;

class AdvertiseCollection extends Collection
{
    /**
     * make response to string
     * @param array|null $data
     * @return string
     */
    protected function makeString(?array $data = []): string
    {
        return "{$this->data->title}";
    }
}