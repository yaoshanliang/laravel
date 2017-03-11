<?php

namespace App\Models;

use App\Models\Model;

class Admin extends Model
{
    protected $fillable = [
        'account', 'name', 'email', 'phone', 'password', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
