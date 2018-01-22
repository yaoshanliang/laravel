<?php

namespace App\Models;

use App\Models\Model;

class WeChatMenu extends Model
{
    protected $table = 'wechat_menus';
    protected $fillable = [
        'pid', 'type', 'title', 'url', 'key', 'has_sub'
    ];
}