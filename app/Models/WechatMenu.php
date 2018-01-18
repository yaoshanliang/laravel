<?php

namespace App\Models;

use App\Models\Model;

class WechatMenu extends Model
{
    protected $fillable = [
        'pid', 'type', 'title', 'url', 'key', 'has_sub'
    ];
}