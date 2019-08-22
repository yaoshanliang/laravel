<?php

Route::group(['prefix' => 'weapp', 'namespace' => 'WeApp'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/login', 'UserController@login');
    });

    // 需要验证token
    Route::group(['middleware' => 'auth.weapp'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/info', 'UserController@getUserInfo');
            Route::post('/info', 'UserController@updateUserInfo');
        });
    
    });

});

