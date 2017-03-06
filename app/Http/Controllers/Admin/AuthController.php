<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'account' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ]);

        if (auth()->guard('admin')->once(['account' => $request->account, 'password' => $request->password, 'status' => 1])) {
            return back()->withInput()->withErrors('该账号已失效,无法登录');
        }

        if (auth()->guard('admin')->attempt(['account' => $request->account, 'password' => $request->password, 'status' => 0])) {
            return redirect()->intended(url('/admin'));
        } else {
            return back()->withInput()->withErrors('账号密码不匹配,请重新输入');
        }

    }

    public function getLogout()
    {
        auth()->guard('admin')->logout();

        return redirect(url('/admin'));
    }

}
