<?php

namespace App\Models;

use App\Core\Abstracts\Model;

class Advertise extends Model
{
    /**
     * @param User $user
     * @param string $title
     * @param string|null $tag
     * @param string|null $publishedAt
     */
    public function __construct(
        public User $user,
        public string $title,
        public ?string $tag = null,
        public ?string $publishedAt = null,
    ){

        $this->publishedAt = time();
    }
}