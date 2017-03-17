<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.admin.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('account', 'name', 'phone', 'email');
        $pre = Admin::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Admin::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|unique:admins',
            'phone' => 'nullable|size:11|unique:admins',
            'email' => 'nullable|email|unique:admins',
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

        Admin::create($data);

        return apiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
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

        return apiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        if ($request->id == getAdminUserId()) {
            return apiReturn(ERROR, '不允许删除自己');
        } else {
            Admin::where('id', $request->id)->delete();

            return apiReturn(SUCCESS, '删除成功');
        }
    }

}
