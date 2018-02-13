<?php

namespace App\Models;

use App\Models\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id', 'file_name', 'file_path', 'extension', 'mime_type', 'size', 'width', 'height', 'qiniu_url'
    ];
}
