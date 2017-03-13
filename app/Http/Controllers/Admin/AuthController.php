<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin', ['only' => 'getLogin']);
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

    public function getPasswordEmail(Request $request)
    {
        return view('admin.auth.password.email');
    }

    public function postPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins',
        ]);

        // 发送邮件

        //return back()->withInput()->withErrors(['success' => '发送成功,请点击邮件链接验证']);
        return back()->withInput()->with('success', '发送成功,请点击邮件链接验证');
    }

    public function getPasswordReset(Request $request)
    {
        $token = $request->token;

        $email = 1;

        return view('admin.auth.password.reset')->with(compact('token', 'email'));
    }

    public function putPasswordReset(Request $request)
    {

    }
}
