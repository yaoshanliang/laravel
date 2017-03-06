<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'realname', 'email', 'phone', 'password', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
