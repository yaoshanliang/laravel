<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function getUser(Request $request)
    {
        return view('admin.system.log.user');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('guard', 'user_id', 'request_method', 'request_url', 'user_ip');
        $pre = Log::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Log::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }
}