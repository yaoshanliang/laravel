<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminAuth extends Authenticatable
{
    protected $table = 'admins';
}
