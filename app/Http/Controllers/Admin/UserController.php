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
        $searchFields = array('account', 'realname', 'phone', 'email');
        $pre = User::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = User::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
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
            'realname' => $request->realname,
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
            'realname' => $request->realname,
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
