<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\WeChatMenu as Menu;

class WeChatMenuController extends Controller
{
    public function getIndex(Request $request)
    {
        $level1 = Menu::where('pid', 0)->orderby('sort', 'asc')->get();

        return view('admin.wechat.menu.index')->with(compact('level1'));
    }

    public function getLists(Request $request)
    {
        $count = Menu::count();
        $level1 = Menu::where('pid', 0)->orderby('sort', 'asc')->get()->toArray();
        $draw = (int)$request->draw;
        $recordsTotal = $count;
        $recordsFiltered = $count;
        $data = [];
        foreach ($level1 as $v) {
            $level2 = Menu::where(['pid' => $v['id']])->orderBy('sort')->get()->toArray();
            $data[] = $v;
            foreach ($level2 as $value) {
                $data[] = $value;
            }
        }

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function post(Request $request)
    {
        $res = Menu::where(['pid' => 0, 'sort' => $request->sort])->first();
        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }

        $count = Menu::where('pid', 0)->count();
        if ($count >= 3) {
            return adminApiReturn(ERROR, '一级菜单最多有三个');
        }

        $this->validate($request, [
            'name' => 'required',
        ],[],['name'=>"菜单名"]);

        $data = [
            'name' => $request->name,
            'type' => $request->menu_type,
            'has_sub' => $request->has_sub,
            'value' => $request->value,
            'sort' => $request->sort,
        ];
        Menu::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
    {
        $res = Menu::where(['pid' => 0, 'sort' => $request->sort])->where('id', '<>', $request->id)->first();

        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }

        $this->validate($request, [
            'name' => 'required',
        ],[],['name'=>"菜单名"]);
//        var_dump($request->input());
        $data = [
            'name' => $request->name,
            'sort' => $request->sort,
            'type' => $request->menu_type,
            'has_sub' => $request->has_sub,
            'value' => isset($request->value) ? $request->value : '',
        ];

        if ($data['has_sub'] == 1) {
            $data['value'] = '';
            $data['type'] = 0;
        } else {
            if ($data['type'] == 1 || $data['type'] == 0) {
                if($data['value'] == '') {
                    return adminApiReturn(ERROR, '修改失败-请输入地址或值');
                }
            }
        }

        $res = Menu::where('id', $request->id)->update($data);
        if ($res) {
            $menu = Menu::find($request->id);
            if ($menu->has_sub == 0) {
                Menu::where('pid', $request->id)->delete();
            }
        }
        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        Menu::where('id', $request->id)->delete();
        Menu::where('pid', $request->id)->delete();
        return adminApiReturn(SUCCESS, '删除成功');
    }

    public function subAdd(Request $request)
    {
        $pid = $request->pid;
        if (! $pid) {
            return adminApiReturn(ERROR, '一级菜单不存在');
        }

        $res = Menu::where(['pid' => $pid, 'sort' => $request->sort])->first();
        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }

        $count = Menu::where('pid', $pid)->count();
        if ($count >= 5) {
            return adminApiReturn(ERROR, '二级菜单最多有5个');
        }
        $this->validate($request, [
            'name' => 'required',
        ],[],['name'=>"菜单名"]);

        $data = [
            'name' => $request->name,
            'sort' => $request->sort,
            'value' => $request->value,
            'type' => $request->menu_type,
            'pid' => $pid
        ];

        Menu::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function subPut(Request $request)
    {
        $res = Menu::where(['pid' => $request->pid, 'sort' => $request->sort])->where('id', '<>', $request->id)->first();
        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }
        $this->validate($request, [
            'name' => 'required',
        ],[],['name'=>"菜单名"]);

        $data = [
            'pid' => $request->pid,
            'name' => $request->name,
            'sort' => $request->sort,
            'type' => $request->menu_type,
            'value' => isset($request->value) ? $request->value : '',
        ];

        Menu::where('id', $request->id)->update($data);
        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function subDelete(Request $request)
    {
        Menu::where('id', $request->id)->delete();
        return adminApiReturn(SUCCESS, '删除成功');
    }
}

