<?php

namespace App\Services\Advertise;

use App\Core\Abstracts\Service;
use App\Exceptions\ServerErrorException;
use App\Mappers\AdvertiseMapper;
use App\Mappers\UserMapper;
use App\Models\Advertise;
use App\Models\User;
use ErrorException;

class RemoveAdvertiseService extends Service
{
    /**
     * @param AdvertiseMapper $advertiseMapper
     * @param UserMapper $userMapper
     * @param Advertise $advertise
     * @param User $user
     */
    public function __construct(
        protected AdvertiseMapper $advertiseMapper,
        protected UserMapper $userMapper,
        protected Advertise $advertise,
        protected User $user
    )
    {
    }

    /**
     * @throws ErrorException
     * @throws ServerErrorException
     */
    public function execute(): void
    {
        if(empty($this->userMapper->findByUsername($this->user->username))){

            throw new ErrorException('invalid username');
        }

        if(empty($advertise = $this->advertiseMapper->findByTitle($this->advertise->title))){

            throw new ErrorException('invalid title');
        }

        if($advertise->user->username !== $this->user->username) {

            throw new ErrorException('access denied');
        }

        if(empty($this->advertiseMapper->delete($advertise))) {

            throw new ServerErrorException();
        }
    }
}