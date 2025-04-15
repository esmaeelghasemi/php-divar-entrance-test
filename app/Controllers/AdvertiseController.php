<?php

namespace App\Controllers;

use App\Core\Abstracts\Controller;
use App\Datasets\AdvertiseDataset;
use App\Datasets\UserDataset;
use App\Exceptions\ServerErrorException;
use App\Helpers\Helper;
use App\Mappers\AdvertiseMapper;
use App\Mappers\UserMapper;
use App\Models\Advertise;
use App\Models\User;
use App\Services\Advertise\AddAdvertiseService;

class AdvertiseController extends Controller
{
    public function add(string $username, string $title): string
    {
        try {

            $user = new User($username);

            $invoked = Helper::invokeService(
                new AddAdvertiseService(
                    new AdvertiseMapper(AdvertiseDataset::instance()),
                    new UserMapper(UserDataset::instance()),
                    new Advertise($user, $title),
                    $user
                )
            );

            return 'posted successfully';

        } catch (\ErrorException $e) {

            return $e->getMessage();

        } catch (ServerErrorException) {

            return 'server error';
        }
    }
}