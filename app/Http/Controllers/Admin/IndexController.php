<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.index.index');
    }

}
