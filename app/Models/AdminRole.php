<?php

namespace App\Models;

use App\Models\Model;

class AdminRole extends Model
{
    protected $fillable = [
        'key', 'name', 'comment', 'is_all_permissions', 'permissions'
    ];
}
