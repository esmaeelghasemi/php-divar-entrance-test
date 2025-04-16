<?php

namespace App\Services\FavoriteAdvertise;

use App\Core\Abstracts\Service;
use App\Exceptions\ServerErrorException;
use App\Mappers\AdvertiseMapper;
use App\Mappers\FavoriteAdvertiseMapper;
use App\Mappers\UserMapper;
use App\Models\Advertise;
use App\Models\FavoriteAdvertise;
use App\Models\User;
use ErrorException;

class RemoveFavoriteAdvertiseService extends Service
{
    public function __construct(
        protected FavoriteAdvertiseMapper $favoriteAdvertiseMapper,
        protected AdvertiseMapper $advertiseMapper,
        protected UserMapper $userMapper,
        protected Advertise  $advertise,
        protected User $user
    )
    {
    }

    /**
     * Execute remove favorite advertise
     * @throws ServerErrorException
     * @throws ErrorException
     */
    public function execute(): void
    {
        if (empty($user = $this->userMapper->findByUsername($this->user->username))) {

            throw new ErrorException('invalid username');
        }

        if (empty($advertise = $this->advertiseMapper->findByTitle($this->advertise->title))) {

            throw new ErrorException('invalid title');
        }

        if (empty($this->favoriteAdvertiseMapper->findByAdvertiseAndUser($advertise->title, $user->username))) {

            throw new ErrorException('already not favorite');
        }

        $favoriteAdvertise = new FavoriteAdvertise($this->user, $this->advertise);

        if (empty($this->favoriteAdvertiseMapper->delete($favoriteAdvertise))) {

            throw new ServerErrorException();
        }
    }
}