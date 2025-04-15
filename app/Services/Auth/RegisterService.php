<?php

namespace App\Services\Auth;

use App\Core\Abstracts\Service;
use App\Exceptions\ServerErrorException;
use App\Mappers\UserMapper;
use App\Models\User;
use ErrorException;

class RegisterService extends Service
{
    /**
     * @param UserMapper $userMapper
     * @param User $user
     */
    public function __construct(
        protected UserMapper $userMapper,
        protected User       $user
    )
    {
    }

    /**
     * Execute register user logic
     * @throws ErrorException
     * @throws ServerErrorException
     */
    public function execute(): void
    {
        if (!empty($this->userMapper->findByUsername($this->user->username))) {

            throw new ErrorException('invalid username');
        }

        if(empty($this->userMapper->insert($this->user))) {

            throw new ServerErrorException();
        }
    }
}