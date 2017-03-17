<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class SelfController extends Controller
{
    // 个人信息
    public function getInfo(Request $request)
    {
        $info = Admin::where('id', getAdminUserId())->first();

        return view('admin.self.info')->with(compact('info'));
    }

    public function postInfo(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|unique:admins,account,'.$request->id,
            'phone' => 'nullable|size:11|unique:admins,account,'.$request->id,
            'email' => 'nullable|email|unique:admins,account,'.$request->id,
        ]);

        $data = [
            'account' => $request->account,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email
        ];

        Admin::where('id', $request->id)->update($data);

        return back()->withInput()->with('success', '修改成功');
    }

    // 修改密码
    public function getPassword(Request $request)
    {
        return view('admin.self.password');
    }

    public function postPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);

        $data = [
            'password' => bcrypt($request->password)
        ];

        Admin::where('id', getAdminUserId())->update($data);

        return back()->withInput()->with('success', '修改成功');
    }

}
