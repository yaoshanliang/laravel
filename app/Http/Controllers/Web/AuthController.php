<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'getLogin']);
    }

    // 登录
    public function getLogin()
    {
        return view('web.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'account' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('account', $request->account)->first();

        if (empty($user)) {
            return back()->withInput()->withErrors('该账号不存在');
        } else {
            if (! password_verify($request->password, $user->password)) {
                return back()->withInput()->withErrors('账号密码不匹配,请重新输入');
            } else {
                auth()->guard('web')->loginUsingId($user->id);

                return redirect()->intended(url('/web'));
            }
        }
    }

    // 退出
    public function getLogout()
    {
        auth()->guard('web')->logout();

        return redirect(url('/web'));
    }

}
