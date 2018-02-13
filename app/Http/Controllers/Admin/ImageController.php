<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use ImageProcessor;
use Storage;

class ImageController extends Controller
{
    public function getIndex(Request $request)
    {
        return view('admin.file.image.index');
    }

    public function getLists(Request $request)
    {
        $searchFields = array('file_name');
        $pre = Image::whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = Image::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    // 上传图片
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'

        ]);

        $file = $request->file('image');
        $directory = 'storage/images/';
        $extension = $file->getClientOriginalExtension();
        $fileOriginalName = $file->getClientOriginalName();
        $fileName = md5($fileOriginalName.time()).'.'.$extension;
        $mimeType = $file->getMimeType();
        $size = round(($file->getClientSize() / 1024), 2).'k';
        $upload = $file->move($directory, $fileName);
        $filePath = $directory.$fileName;

        $imageProcessor = ImageProcessor::make(public_path($filePath));
        $height = $imageProcessor->height();
        $width = $imageProcessor->width();

        $data = [
            'user_id' => getAdminUserId(),
            'file_name' => $fileOriginalName,
            'file_path' => $filePath,
            'extension' => $extension,
            'mime_type' => $mimeType,
            'size' => $size,
            'height' => $height,
            'width' => $width,
        ];

        // 上传至七牛
        if (env('QINIU_ACCESS_KEY')) {
            $disk = Storage::disk('qiniu')->put($fileName, file_get_contents($filePath));
            $data['qiniu_url'] = env('QINIU_DOMAIN') . '/' . $fileName;
        }

        Image::create($data);

        return adminApiReturn(SUCCESS, '上传成功', $data);
    }

    // 删除
    public function delete(Request $request)
    {
        Image::where('id', $request->id)->delete();

        return adminApiReturn(SUCCESS, '删除成功');
    }

}
