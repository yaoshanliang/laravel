<?php

namespace App\Http\Controllers\WeApp;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $app = app('wechat.mini_program');
        $result = $app->auth->session($request->code);

        $user = User::where('weapp_openid', $result['openid'])->first();
        if (! $user) {
            $user = User::create(['weapp_openid' => $result['openid'], 'weapp_nickname' => $request->nickName, 'weapp_avatar' => $request->avatarUrl]);
        }

        return weappReturn(SUCCESS, '登录成功', ['id' => $user->id, 'openid' => $user->weapp_openid, 'nickname' => $user->weapp_nickname, 'avatar' => $user->weapp_avatar, 'token' => $user->weapp_openid]);
    }

    public function getUserInfo(Request $request)
    {
        $user = User::where('id', getWeappUserId())->first();

        return weappReturn(SUCCESS, '获取成功', ['id' => $user->id, 'openid' => $user->weapp_openid, 'nickname' => $user->weapp_nickname, 'avatar' => $user->weapp_avatar, 'created_at' => $user['created_at']]);
    }
}