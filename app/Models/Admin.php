<?php

namespace App\Models;

use App\Models\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Admin extends Model
{
    use LogsActivity;

    protected $fillable = [
        'account', 'name', 'email', 'phone', 'role_id', 'role_name', 'password', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $logAttributes = ['account', 'name', 'email', 'phone', 'role_id', 'role_name'];

    protected static $logOnlyDirty = true;
}
