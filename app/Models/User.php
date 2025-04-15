<?php

namespace App\Models;

use App\Core\Abstracts\Model;

class User extends Model
{
    /**
     * @param string $username
     */
    public function __construct(
        public string $username
    ){}
}