<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.user.index');
    }

    public function getLists(Request $request)
    {
        $pre = User::whereLayui($request, ['id', 'account', 'name', 'phone', 'email']);
        $count = $pre->count();
        $data = $pre->skip(($request->page - 1) * $request->limit)->take($request->limit)->get();


        return response()->json(['code' => 0, 'msg' => '获取成功', 'count' => $count, 'data' => $data]);
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|unique:users',
            'phone' => 'nullable|size:11|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $data = [
            'account' => $request->account,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 0
        ];

        User::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|unique:users,account,'.$request->id,
            'phone' => 'nullable|size:11|unique:users,account,'.$request->id,
            'email' => 'nullable|email|unique:users,account,'.$request->id,
        ]);

        $data = [
            'account' => $request->account,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email
        ];

        User::where('id', $request->id)->update($data);

        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        if ($request->id == getAdminUserId()) {
            return adminApiReturn(ERROR, '不允许删除自己');
        } else {
            User::where('id', $request->id)->delete();

            return adminApiReturn(SUCCESS, '删除成功');
        }
    }

}
