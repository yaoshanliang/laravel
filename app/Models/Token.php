<?php

namespace App\Models;

use App\Models\Model;

class Token extends Model
{
    protected $fillable = [
        'token', 'user_id', 'client', 'expired_at'
    ];
}
