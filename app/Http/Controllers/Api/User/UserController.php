<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 获取用户信息
    public function getInfo(Request $request)
    {
        return apiReturn(SUCCESS, '获取用户信息成功', getApiUser($request->token));
    }

}
