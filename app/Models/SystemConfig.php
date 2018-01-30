<?php

namespace App\Models;

use App\Models\Model;

class SystemConfig extends Model
{
    protected $fillable = [
        'key', 'value', 'description'
    ];
}