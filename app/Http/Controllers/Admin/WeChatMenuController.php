<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\WeChatMenu as Menu;

class WeChatMenuController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.wechat.menu.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('title');
        $pre = Menu::where("pid",0)->whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Menu::count();
        $recordsFiltered = min($count, $recordsTotal);

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
            'title' => 'required',
        ],[],['title'=>"菜单名"]);

        $data = [
            'title' => $request->title,
            'has_sub' => $request->has_sub,
            'url' => $request->url,
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
            'title' => 'required',
        ],[],['title'=>"菜单名"]);

        $data = [
            'title' => $request->title,
            'sort' => $request->sort,
            'has_sub' => $request->has_sub,
            'url' => isset($request->url) ? $request->url : '',
        ];
        if ($data['has_sub'] == 1) {
            $data['url'] = '';
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

    public function getSubIndex(Request $request)
    {
        $pid = $request->pid;

        return view('admin.wechat.menu.subIndex', compact('pid'));
    }

    public function getSubLists(Request $request)
    {
        $pid = $request->pid;
        $searchFields = array('title');
        $pre = Menu::where("pid",$pid)->whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Menu::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function subAdd(Request $request)
    {
        $pid = $request->pid;

        $res = Menu::where(['pid' => $pid, 'sort' => $request->sort])->first();
        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }

        $count = Menu::where('pid', $pid)->count();
        if ($count >= 5) {
            return adminApiReturn(ERROR, '二级菜单最多有5个');
        }
        $this->validate($request, [
            'title' => 'required',
        ],[],['title'=>"菜单名"]);

        $data = [
            'title' => $request->title,
            'sort' => $request->sort,
            'url' => $request->url,
            'pid' => $pid
        ];

        Menu::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function subEdit(Request $request)
    {
        $result = Menu::find($request->id);
        $res = Menu::where(['pid' => $result->pid, 'sort' => $request->sort])->where('id', '<>', $request->id)->first();
        if ($res) {
            return adminApiReturn(ERROR, '顺序重复');
        }
        $this->validate($request, [
            'title' => 'required',
        ],[],['title'=>"菜单名"]);

        $data = [
            'title' => $request->title,
            'sort' => $request->sort,
            'url' => isset($request->url) ? $request->url : '',
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

