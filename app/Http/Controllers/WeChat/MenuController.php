<?php
namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\WeChat\Controller;
use Illuminate\Http\Request;
use App\Models\WeChatMenu as Menu;
use Mockery\Exception;

class MenuController extends Controller
{
    public $menu;
    public function __construct()
    {
        $app = app('wechat.official_account');
        $this->menu = $app->menu;
    }

    public function setMenu()
    {
        $buttons = [];
        $level1 = Menu::where(['pid' => 0])->orderBy('sort')->get();
        foreach($level1 as $k => $v) {
            if ($v->has_sub == 1) {
                $buttons[$k]['name'] = $v->title;
                $buttons[$k]['sub_button'] = [];
                $level2 = Menu::where(['pid' => $v->id])->orderBy('sort')->get();
                foreach($level2 as $key => $val) {
                    $buttons[$k]['sub_button'][$key]['type'] = 'view';
                    $buttons[$k]['sub_button'][$key]['name'] = $val->title;
                    $buttons[$k]['sub_button'][$key]['url'] = $val->url;
                }
            } else {
                $buttons[$k]['type'] = 'view';
                $buttons[$k]['name'] = $v->title;
                $buttons[$k]['url'] = $v->url;
            }
        }

        try{
            $res = $this->menu->create($buttons);
            if($res['errcode'] === 0 ) {
                return webApiReturn(SUCCESS, '设置成功');
            } else {
                return webApiReturn(SUCCESS, '设置失败');
            }
        }catch (Exception $e) {
            return webApiReturn(ERROR, '设置失败');
        }

    }
}
