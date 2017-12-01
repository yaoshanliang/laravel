<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminRole;

class RoleController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.admin.role.index');
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
            'permissions' => json_encode([])
        ];

        AdminRole::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|alpha_dash|unique:admin_roles,key,'.$request->id,
            'name' => 'required'
        ]);

        $data = [
            'key' => $request->key,
            'name' => $request->name,
            'comment' => $request->comment,
        ];

        AdminRole::where('id', $request->id)->update($data);

        return adminApiReturn(SUCCESS, '修改成功');
    }

    // 删除
    public function delete(Request $request)
    {
        $role = AdminRole::where('id', $request->id)->first();

        if (Admin::where('role_key', $role->key)->exists()) {

            return adminApiReturn(ERROR, '该角色存在用户');
        } else {
            AdminRole::where('id', $request->id)->delete();

            return adminApiReturn(SUCCESS, '删除成功');
        }
    }

    // 更新权限
    public function putPermission(Request $request)
    {
        if ($request->is_all_permissions) {
            $request->permissions = [];
        }

        AdminRole::where('id', $request->id)->update([
            'is_all_permissions' => $request->is_all_permissions,
            'permissions' => json_encode($request->permissions)
        ]);

        return adminApiReturn(SUCCESS, '更新成功');
    }

}
