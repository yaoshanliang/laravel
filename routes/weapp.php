<?php

Route::group(['prefix' => 'weapp', 'namespace' => 'WeApp'], function () {
    Route::get('/login', 'WeAppController@login');
    Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
        Route::get('/user', function () {
            $user = session('wechat.oauth_user'); // 拿到授权用户资料

            dd($user);
        });
    });
});

