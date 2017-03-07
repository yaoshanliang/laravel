<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAuth extends Authenticatable
{
    protected $table = 'users';
}
