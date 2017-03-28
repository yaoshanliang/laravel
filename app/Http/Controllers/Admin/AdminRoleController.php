<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\AdminRole;

class AdminRoleController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.adminrole.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('name');
        $pre = AdminRole::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = AdminRole::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|alpha_dash|unique:admin_roles',
            'name' => 'required'
        ]);

        $data = [
            'key' => $request->key,
            'name' => $request->name,
            'comment' => $request->comment,
        ];

        AdminRole::create($data);

        return apiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|alpha_dash|unique:admin_roles,key,'.$request->key,
            'name' => 'required'
        ]);

        $data = [
            'key' => $request->key,
            'name' => $request->name,
            'comment' => $request->comment,
        ];

        AdminRole::where('id', $request->id)->update($data);

        return apiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        if ($request->id == getAdminUserId()) {
            return apiReturn(ERROR, '不允许删除自己');
        } else {
            AdminRole::where('id', $request->id)->delete();

            return apiReturn(SUCCESS, '删除成功');
        }
    }

}
