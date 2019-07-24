<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use App\Models\Token;

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
                $expired_at = getTimeByTimestamp(getNowTimestamp() + config('project.api.token_expires_in'));

                Token::create([
                    'token' => $token,
                    'user_id' => $user->id,
                    'client' => $request->client,
                    'expired_at' => $expired_at
                ]);

                $userInfo = array_merge($user->toArray(), ['token' => $token, 'expired_at' => $expired_at]);
                return apiReturn(SUCCESS, '登录成功', $userInfo);
            }
        }
    }

    // 退出
    public function postLogout(Request $request)
    {
        Token::where('token', $request->token)->delete();

        return apiReturn(SUCCESS, '退出成功');
    }
}
