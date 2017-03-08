<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('web.index.index');
    }

}
