<?php

namespace App\Controllers;

use App\Collections\FavoriteAdvertiseCollection;
use App\Core\Abstracts\Controller;
use App\Datasets\AdvertiseDataset;
use App\Datasets\FavoriteAdvertiseDataset;
use App\Datasets\UserDataset;
use App\Exceptions\ServerErrorException;
use App\Helpers\Helper;
use App\Mappers\AdvertiseMapper;
use App\Mappers\FavoriteAdvertiseMapper;
use App\Mappers\UserMapper;
use App\Models\Advertise;
use App\Models\User;
use App\Services\FavoriteAdvertise\AddFavoriteAdvertiseService;
use App\Services\FavoriteAdvertise\RemoveFavoriteAdvertiseService;

class FavoriteAdvertiseController extends Controller
{
    protected AdvertiseMapper $advertiseMapper;
    protected UserMapper $userMapper;
    protected FavoriteAdvertiseMapper $favoriteAdvertiseMapper;

    public function __construct()
    {
        $this->advertiseMapper = new AdvertiseMapper(AdvertiseDataset::instance());
        $this->userMapper = new UserMapper(UserDataset::instance());
        $this->favoriteAdvertiseMapper = new FavoriteAdvertiseMapper(FavoriteAdvertiseDataset::instance());
    }

    /**
     * Add advertise to user favorites ads
     * @param string $username
     * @param string $title
     * @return string
     */
    public function add(string $username, string $title): string
    {
        $user = new User($username);
        $advertise = new Advertise($user, $title);

        try {

            $invoked = Helper::invokeService(
                new AddFavoriteAdvertiseService(
                    $this->favoriteAdvertiseMapper,
                    $this->advertiseMapper,
                    $this->userMapper,
                    $advertise,
                    $user
                )
            );

            return 'added successfully';

        } catch (\ErrorException $e) {

            return $e->getMessage();

        } catch (ServerErrorException $e) {

            return 'server error';
        }
    }

    /**
     * Remove advertise from user favorites
     * @param string $username
     * @param string $title
     * @return string
     */
    public function remove(string $username, string $title): string
    {
        $user = new User($username);
        $advertise = new Advertise($user, $title);

        try {

            $invoked = Helper::invokeService(
                new RemoveFavoriteAdvertiseService(
                    $this->favoriteAdvertiseMapper,
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
     * Get user favorite list
     * @param string $username
     * @param string|null $tag
     * @return string
     */
    public function myFavorites(string $username, ?string $tag = null): string
    {
        $user = new User($username);

        if (empty($this->userMapper->findByUsername($username))) {

            return 'invalid username';
        }

        $favoriteAdvertises = !empty($tag) ?
            $this->favoriteAdvertiseMapper->getUserFavoriteAdvertisesByTag($user, $tag) :
            $this->favoriteAdvertiseMapper->getUserFavoriteAdvertises($user);

        return FavoriteAdvertiseCollection::collect($favoriteAdvertises)->toString();
    }
}