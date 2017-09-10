<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin;
use App\Models\PasswordReset;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use App\Models\AdminRole;
use Gregwar\Captcha\CaptchaBuilder;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'getLogout']);
    }

    // 登录
    public function getLogin()
    {
        $builder = new CaptchaBuilder;
        $builder->build();
        session(['captcha' => $builder->getPhrase()]);

        return view('admin.auth.login')->with(['builder' => $builder]);
    }

    // 验证码
    public function getCaptcha()
    {
        $builder = new CaptchaBuilder;
        $builder->build();
        session(['captcha' => $builder->getPhrase()]);

        return response()->json($builder->inline());
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'account' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ]);

        if (session('captcha') != $request->captcha) {
            return back()->withInput()->withErrors('验证码错误,请重新输入');
        }

        $admin = Admin::where('account', $request->account)->first();

        if (empty($admin)) {
            return back()->withInput()->withErrors('该账号不存在');
        } else {
            if (! password_verify($request->password, $admin->password)) {
                return back()->withInput()->withErrors('账号密码不匹配,请重新输入');
            } else {
                auth()->guard('admin')->loginUsingId($admin->id);

                return redirect()->intended(url('/admin'));
            }
        }
    }

    // 退出
    public function getLogout()
    {
        auth()->guard('admin')->logout();

        return redirect(url('/admin/auth/login'));
    }

    // 忘记密码
    public function getPasswordEmail(Request $request)
    {
        return view('admin.auth.password.email');
    }

    public function postPasswordEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins',
        ]);

        $this->sendResetLinkEmail($request->email);

        return back()->withInput()->with('success', '发送成功,请点击邮件链接验证');
    }

    private function sendResetLinkEmail($email)
    {
        $token = generateToken();

        PasswordReset::where('email', $email)->delete();

        PasswordReset::create(['email' => $email, 'token' => $token, 'created_at' => getNowTime()]);

        // 发送邮件
        Mail::send('admin.auth.password.password', ['token' => $token, 'email' => $email], function ($m) use ($email) {
            $m->from(env('MAIL_USERNAME'), env('MAIL_FROMNAME'));
            $m->to($email, $email)->subject('密码重置');
        });

        return true;
    }

    // 重置密码
    public function getPasswordReset(Request $request)
    {
        $token = $request->token;

        $email = $request->email;

        return view('admin.auth.password.reset')->with(compact('token', 'email'));
    }

    public function postPasswordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:admins',
            'password' => 'required|confirmed'
        ]);

        if (! PasswordReset::where('email', $request->email)->where('token', $request->token)->exists()) {
            return back()->withInput()->withErrors('验证链接无效');
        }

        PasswordReset::where('email', $request->email)->delete();

        Admin::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        return back()->withInput()->with('success', '重置成功,请返回登录');
    }
}
