<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Overtrue\EasySms\EasySms;
use Log;

class SmsController extends Controller
{
    public function send(Request $request)
    {
        $code = rand(100000, 999999);

        $easySms = new EasySms(config('sms'));

        $res = $easySms->send($request->phone, [
            'content'  => '您的验证码为: '.$code,
            'template' => env('ALIYUN_TEMPLATE_ID'),
            'data' => [
                'code' => $code
            ],
        ]);

        Log::info('发送短信: ' . $request->phone . ', 返回:' . json_encode($res));

        if ($res['aliyun']['status'] == 'success') {
            $key = 'sms_code_' . $request->phone;
            cache([$key => $code], 1);

            return apiReturn(0, '发送成功');
        } else {
            return apiReturn(1, '发送失败');
        }
    }
}
