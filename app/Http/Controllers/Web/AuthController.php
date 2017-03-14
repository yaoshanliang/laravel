<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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


        if (auth()->guard('web')->once(['account' => $request->account, 'password' => $request->password, 'status' => 1])) {
            return back()->withInput()->withErrors('该账号已失效,无法登录');
        }

        if (auth()->guard('web')->attempt(['account' => $request->account, 'password' => $request->password, 'status' => 0])) {
            return redirect()->intended(url('/web'));
        } else {
            return back()->withInput()->withErrors('账号密码不匹配,请重新输入');
        }
    }

    // 退出
    public function getLogout()
    {
        auth()->guard('web')->logout();

        return redirect(url('/web'));
    }

}
