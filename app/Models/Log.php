<?php

namespace App\Models;

use App\Models\Model;

class Log extends Model
{

    protected $fillable = [
        'guard', 'user_id', 'request_method', 'request_url', 'request_params', 'response_code', 'response_message', 'response_data',
        'user_ip', 'user_agent', 'server_ip', 'request_time_float', 'pushed_time_float', 'poped_time_float', 'created_time_float', 'created_at'
    ];

    public $timestamps = false;
}
