<?php

namespace App\Models;

use App\Models\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token', 'created_at'
    ];

    public $timestamps = false;
}
