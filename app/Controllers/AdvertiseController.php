<?php

namespace App\Controllers;

use App\Collections\AdvertiseCollection;
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
use App\Services\Advertise\RemoveAdvertiseService;

class AdvertiseController extends Controller
{
    protected AdvertiseMapper $advertiseMapper;
    protected UserMapper $userMapper;


    public function __construct()
    {
        $this->advertiseMapper = new AdvertiseMapper(AdvertiseDataset::instance());
        $this->userMapper = new UserMapper(UserDataset::instance());
    }

    /**
     * Add advertise
     * @param string $username
     * @param string $title
     * @return string
     */
    public function add(string $username, string $title): string
    {
        try {

            $user = new User($username);

            $invoked = Helper::invokeService(
                new AddAdvertiseService(
                    $this->advertiseMapper,
                    $this->userMapper,
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

    /**
     * remove advertise
     * @param string $username
     * @param string $title
     * @return string
     */
    public function remove(string $username, string $title): string
    {

        try {

            $user = new User($username);
            $advertise = new Advertise($user, $title);

            $invoked = Helper::invokeService(
                new RemoveAdvertiseService(
                    $this->advertiseMapper,
                    $this->userMapper,
                    $advertise,
                    $user
                )
            );

            return 'removed successfully';

        } catch (\ErrorException $e) {

            return $e->getMessage();

        } catch (ServerErrorException $e) {

            return 'server error';
        }
    }

    /**
     * my advertises
     * @param string $username
     * @return string
     */
    public function myAdvertises(string $username): string
    {
        $user = new User($username);

        if(empty($this->userMapper->findByUsername($username))) {

            return 'invalid username';
        }

        $advertises = $this->advertiseMapper->getUserAdvertises($user);

        return AdvertiseCollection::collect($advertises)->toString();
    }
}