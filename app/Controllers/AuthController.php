<?php

namespace App\Controllers;

use App\Core\Abstracts\Controller;
use App\Datasets\UserDataset;
use App\Exceptions\ServerErrorException;
use App\Helpers\Helper;
use App\Mappers\UserMapper;
use App\Models\User;
use App\Services\Auth\RegisterService;
use ErrorException;

class AuthController extends Controller
{
    /**
     * Register user
     * @param string $username
     * @return string
     */
    public function register(string $username): string
    {
        try {

            $invoked = Helper::invokeService(new RegisterService(
                new UserMapper(
                    UserDataset::instance()
                ),
                new User($username)
            ));

            return 'registered successfully';

        } catch (ErrorException $e) {

            return $e->getMessage();

        } catch (ServerErrorException $e) {

            return 'server error';
        }
    }
}