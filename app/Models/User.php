<?php

namespace App\Models;

use App\Models\Model;

class User extends Model
{
    protected $fillable = [
        'account', 'realname', 'email', 'phone', 'password', 'status',
        'openid', 'nickname', 'headimgurl'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
