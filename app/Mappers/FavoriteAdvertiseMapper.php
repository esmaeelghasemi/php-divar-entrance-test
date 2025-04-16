<?php

namespace App\Mappers;

use App\Core\Abstracts\Mapper;
use App\Core\Abstracts\Model;
use App\Models\Advertise;
use App\Models\FavoriteAdvertise;
use App\Models\User;

class FavoriteAdvertiseMapper extends Mapper
{
    /**
     * find favorite advertise by title and username
     * @param string $advertiseTitle
     * @param string $username
     * @return Model|null
     */
    public function findByAdvertiseAndUser(string $advertiseTitle, string $username): ?FavoriteAdvertise
    {
        return $this->dataset->select([
            'advertise.title' => $advertiseTitle,
            'user.username' => $username,
        ]);
    }

    /**
     * Get user favorite advertises
     * @param User $user
     * @return array
     */
    public function getUserFavoriteAdvertises(User $user): array
    {
        return $this->dataset->select([
            'user.username' => $user->username,
        ], true);
    }

    /**
     * Get user favorite advertises by tag
     * @param User $user
     * @param string $tag
     * @return array
     */
    public function getUserFavoriteAdvertisesByTag(User $user, string $tag): array
    {
        return $this->dataset->select([
            'user.username' => $user->username,
            'advertise.tag' => $tag,
        ], true);
    }
}