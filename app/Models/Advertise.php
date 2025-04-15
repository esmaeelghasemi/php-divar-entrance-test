<?php

namespace App\Models;

use App\Core\Abstracts\Model;

class Advertise extends Model
{
    /**
     * @param User $user
     * @param string $title
     */
    public function __construct(
        public User $user,
        public string $title,
    ){}
}