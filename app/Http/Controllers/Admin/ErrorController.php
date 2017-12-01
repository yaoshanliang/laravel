<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function get(Request $request, $id)
    {
        return view('admin.error.index')->with(compact('id'));
    }
}
