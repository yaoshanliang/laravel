<?php

Route::group(['prefix' => 'wechat', 'namespace' => 'WeChat'], function () {
    Route::any('/', 'WeChatController@serve');
    Route::get('/menu', 'MenuController@setMenu');
    Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
        Route::get('/user', function () {
            $user = session('wechat.oauth_user'); // 拿到授权用户资料

            dd($user);
        });
    });
});

