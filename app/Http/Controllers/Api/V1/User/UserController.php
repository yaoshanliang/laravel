<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 登录
    public function postLogin(Request $request)
    {
        $data = array_merge(config('project.auth'), ['username' => $request->username, 'password' => $request->password]);
        $url = config('project.ehsApi.login');
        $login = json_decode(curlPost($url, $data));

        if (EHSSUCCESS == $login->status_code) {
            // todo:写入用户信息
            return apiReturn(SUCCESS, '登录成功', []);
        } else {
            return apiReturn(ERROR, $login->message, []);
        }
    }

    // 获取用户信息
    public function getUserInfo(Request $request)
    {
        return apiReturn(SUCCESS, '获取成功', getUserInfoByToken($request->token));
    }
}
