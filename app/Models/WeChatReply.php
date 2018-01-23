<?php

namespace App\Models;

use App\Models\Model;

class WeChatReply extends Model
{
    protected $table = 'wechat_replys';
    protected $fillable = [
        'type', 'keyword', 'content', 'title', 'image', 'link'
    ];
}