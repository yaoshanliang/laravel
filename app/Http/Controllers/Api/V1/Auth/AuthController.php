<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\User;

class AuthController extends Controller
{
    // 登录
    public function postLogin(Request $request)
    {
        $this->apiValidate($request, [
            'account' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('account', $request->account)->first();

        if (empty($user)) {
            return apiReturn(ERROR, '该账号不存在');
        } else {
            if (! password_verify($request->password, $user->password)) {
                return apiReturn(ERROR, '账号密码不匹配,请重新输入');
            } else {
                $token = generateToken();
                $userInfo = array_merge($user->toArray(), ['token' => $token]);
                return apiReturn(SUCCESS, '登录成功', $userInfo);
            }
        }
    }

    // 退出
    public function postLogout(Request $request)
    {
        return apiReturn(SUCCESS, '退出成功');
    }
}
