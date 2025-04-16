<?php

namespace App\Models;

use App\Core\Abstracts\Model;

class FavoriteAdvertise extends Model
{
    /**
     * @param User $user
     * @param Advertise $advertise
     * @param string|null $publishedAt
     */
    public function __construct(
        public User $user,
        public Advertise $advertise,
        public ?string $publishedAt = null,
    ){

        $this->publishedAt = time();
    }
}