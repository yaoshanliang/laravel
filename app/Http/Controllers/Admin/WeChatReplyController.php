<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\WeChatReply;
use App\Models\Image;
use ImageProcessor;

class WeChatReplyController extends Controller
{
    public function getIndex(Request $request)
    {
        $type = $request->type;
        if ($type == 1) {
            return view('admin.wechat.reply.news', compact('type'));
        }
        return view('admin.wechat.reply.text', compact('type'));
    }

    public function getLists(Request $request)
    {
        $searchFields = array('keyword');
        $type = $request->type;
        $pre = WeChatReply::where("type", $type)->whereDataTables($request, $searchFields)->orderByDataTables($request);
        $count = $pre->count();
        $data = $pre->skip($request->start)->take($request->length)->get();
        $draw = (int)$request->draw;
        $recordsTotal = WeChatReply::count();
        $recordsFiltered = min($count, $recordsTotal);

        return response()->json(compact('draw', 'recordsFiltered', 'recordsTotal', 'data'));
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $file = $request->file('image');
        $directory = 'storage/wechat/';
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
//            'user_id' => getAdminUserId(),
            'file_name' => $fileOriginalName,
            'file_path' => $filePath,
            'extension' => $extension,
            'mime_type' => $mimeType,
            'size' => $size,
            'height' => $height,
            'width' => $width
        ];

        Image::create($data);

        return adminApiReturn(SUCCESS, '上传成功', $data);
    }

    public function textAdd(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|unique:wechat_replys',
            'content' => 'required',
        ],[],['keyword'=>"关键字", 'content' => '回复内容']);

        $data = [
            'keyword' => $request->keyword,
            'content' => $request->content,
        ];
        WeChatReply::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function textEdit(Request $request)
    {
        $this->validate($request, [
//            'keyword' => 'required|unique:wechat_replys,keyword,'.$request->id,
            'content' => 'required',
        ], [], ['keyword'=>"关键字", 'content' => '回复内容']);

        $data = [
//            'keyword' => $request->keyword,
            'content' => $request->content,
        ];

        WeChatReply::where('id', $request->id)->update($data);

        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'keyword' => 'required|unique:wechat_replys',
            'title' => 'required',
            'content' => 'required',
            'link' => 'required|url',
        ],[],['image'=>"图文封面",'keyword'=>"关键字",'title'=>"图文标题","content"=>"图文简介","link"=>"图文链接"]);

        $data = [
            'keyword' => $request->keyword,
            'title' => $request->title,
            'link' => $request->link,
            'image' => $request->image,
            'content' => $request->content,
            'type' => 1
        ];

        WeChatReply::create($data);

        return adminApiReturn(SUCCESS, '创建成功');
    }

    public function put(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'link' => 'required|url',
        ],[],['keyword'=>"关键字",'title'=>"图文标题","content"=>"图文简介","link"=>"图文链接"]);

        $data = [
//            'keyword' => $request->keyword,
            'title' => $request->title,
            'link' => $request->link,
            'image' => $request->image,
            'content' => $request->content,
        ];

        WeChatReply::where('id', $request->id)->update($data);

        return adminApiReturn(SUCCESS, '修改成功');
    }

    public function delete(Request $request)
    {
        WeChatReply::where('id', $request->id)->delete();
        return adminApiReturn(SUCCESS, '删除成功');
    }
}