<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\SystemConfig;

class SystemConfigController extends Controller
{
    public function getIndex()
    {
        return view('admin.system.config.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('key');
        $pre = SystemConfig::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = SystemConfig::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|unique:system_configs',
            'value' => 'required',
        ], [], ['key'=>"键名", "value" => '键值']);

        $data = [
            'key' => $request->key,
            'value' => $request->value,
            'description' => $request->description,
        ];

        SystemConfig::create($data);

        return adminApiReturn(SUCCESS, '添加成功');
    }

    public function put(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|unique:system_configs,key,'.$request->id,
            'value' => 'required',
        ], [], ['key'=>"键名", "value" => '键值']);

        $data = [
            'key' => $request->key,
            'value' => $request->value,
            'description' => $request->description,
        ];

        SystemConfig::where('id', $request->id)->update($data);

        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        SystemConfig::where('id', $request->id)->delete();
        return adminApiReturn(SUCCESS, '删除成功');
    }
}