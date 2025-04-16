<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Models\Advertise;
use App\Models\User;

class AdvertiseMapper extends Mapper
{

    /**
     * find user by username
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): ?Advertise
    {
        return $this->dataset->select(['title' => $title]);
    }

    /**
     * Get user advertises
     * @param User $user
     * @return array
     */
    public function getUserAdvertises(User $user): array
    {
        return $this->dataset->select([
            'user.username' => $user->username,
        ], true);
    }

    /**
     * Get user advertises by tag
     * @param User $user
     * @param string $tag
     * @return array
     */
    public function getUserAdvertisesByTag(User $user, string $tag): array
    {
        return $this->dataset->select([
            'user.username' => $user->username,
            'tag' => $tag,
        ], true);
    }
}