<?php

namespace App\Http\Controllers\WeApp;
use Illuminate\Http\Request;
use App\Models\User;
use Log;

class WeAppController extends Controller
{

    public function login(Request $request)
    {
        $app = app('wechat.mini_program');
        $result = $app->auth->session($request->code);

        $user = User::where('weapp_openid', $result['openid'])->first();
        if (! $user) {
            $user = User::create(['weapp_openid' => $result['openid'], 'weapp_nickname' => $request->nickName, 'weapp_avatar' => $request->avatarUrl]);
        }

        $token = 1;

        return apiReturn(SUCCESS, '登录成功', ['id' => $user->id, 'nickname' => $user->weapp_nickname, 'avatar' => $user->weapp_avatar, 'token' => $token]);
    }
}