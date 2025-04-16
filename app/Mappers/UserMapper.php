<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Datasets\UserDataset;
use App\Models\User;

class UserMapper extends Mapper
{
    /**
     * find user by username
     * @param string $username
     * @return Model|null
     */
    public function findByUsername(string $username): ?User
    {
        return $this->dataset->select(['username' => $username]);
    }
}