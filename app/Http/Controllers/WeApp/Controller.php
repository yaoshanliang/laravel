<?php

namespace App\Http\Controllers\WeApp;

use App\Http\Controllers\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    protected function getUserIdByOpenId($openid) {
        $user = User::where('weapp_openid', $openid)->first();
        if (! $user) {
            return $user->id;
        } else {
            return '';
        }
    }
}
