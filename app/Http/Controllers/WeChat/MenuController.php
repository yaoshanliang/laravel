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
                $buttons[$k]['name'] = $v->name;
                $buttons[$k]['sub_button'] = [];
                $level2 = Menu::where(['pid' => $v->id])->orderBy('sort')->get();
                foreach($level2 as $key => $val) {
                    if($val->type == 0) {
                        $buttons[$k]['sub_button'][$key]['type'] = 'view';
                        $buttons[$k]['sub_button'][$key]['name'] = $val->name;
                        $buttons[$k]['sub_button'][$key]['url'] = $val->value;
                    }elseif($val->type == 1) {
                        $buttons[$k]['sub_button'][$key]['type'] = 'click';
                        $buttons[$k]['sub_button'][$key]['name'] = $val->name;
                        $buttons[$k]['sub_button'][$key]['key'] = $val->value;
                    }elseif($val->type == 2) {
                        $buttons[$k]['sub_button'][$key]['type'] = 'miniprogram';
                        $buttons[$k]['sub_button'][$key]['name'] = $val->name;
                        $buttons[$k]['sub_button'][$key]['appid'] = $val->app_id;
                        $buttons[$k]['sub_button'][$key]['pagepath'] = $val->page_path;
                    }

                }
            } else {
                if($val->type == 0) {
                    $buttons[$k]['type'] = 'view';
                    $buttons[$k]['name'] = $v->name;
                    $buttons[$k]['url'] = $v->value;
                }elseif($val->type == 1) {
                    $buttons[$k]['type'] = 'click';
                    $buttons[$k]['name'] = $v->name;
                    $buttons[$k]['key'] = $v->value;
                }elseif($val->type == 2) {
                    $buttons[$k]['type'] = 'miniprogram';
                    $buttons[$k]['name'] = $v->name;
                    $buttons[$k]['appid'] = $v->app_id;
                    $buttons[$k]['pagepath'] = $v->page_path;
                }

            }
        }

        try{
            $res = $this->menu->add($buttons);
            if ($res['errcode'] === 0) {
                return webApiReturn(SUCCESS, '同步成功');
            } else {
                var_dump($res);
                return webApiReturn(ERROR, '同步失败');
            }

        }catch (\Exception $e) {
            var_dump($e);
            return webApiReturn(ERROR, '同步失败');
        }
    }
}
