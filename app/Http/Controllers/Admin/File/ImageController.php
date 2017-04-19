<?php

namespace App\Http\Controllers\Admin\File;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use ImageProcessor;

class ImageController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.file.image.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('account', 'name', 'phone', 'email');
        $pre = Image::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Image::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'

        ]);

        $img = ImageProcessor::make($_FILES['image']['tmp_name']);

        $img->save('foo/bar.jpg');

        /*$data = [

        ];

        Image::create($data);*/

        return adminApiReturn(SUCCESS, '上传成功', $img);
    }


    public function delete(Request $request)
    {
        Image::where('id', $request->id)->delete();

        return adminApiReturn(SUCCESS, '删除成功');
    }

}
