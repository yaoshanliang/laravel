<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.log.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('account', 'name', 'phone', 'email');
        $pre = Log::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Log::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }
}