<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index.index');
});

Route::group(['prefix' => 'web', 'namespace' => 'Web'], function () {

    // 不需要登录的路由
    Route::group([], function () {

        // 首页
        Route::get('', 'IndexController@getIndex');

        // auth
        Route::group(['prefix' => 'auth'], function () {
            Route::get('login', 'AuthController@getLogin');
            Route::post('login', 'AuthController@postLogin');
        });

        // 短信
        Route::group(['prefix' => 'sms'], function () {
            Route::get('send', 'SmsController@send');
        });
    });

    // 需要登录才能访问的路由
    Route::group(['middleware' => 'auth.web'], function () {

        // auth
        Route::group(['prefix' => 'auth'], function () {
            Route::get('logout', 'AuthController@getLogout');

            Route::get('password', 'AuthController@getPassword');
            Route::post('password', 'AuthController@postPassword');

        });
    });
});
