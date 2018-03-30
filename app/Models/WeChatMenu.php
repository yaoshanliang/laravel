<?php

namespace App\Models;

use App\Models\Model;

class WeChatMenu extends Model
{
    protected $table = 'wechat_menus';
    protected $fillable = [
        'type', 'name', 'has_sub', 'value', 'sort', 'pid'
    ];
}