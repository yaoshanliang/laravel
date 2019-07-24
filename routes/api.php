<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {

    // auth
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

        // 不需要验证token的api
        Route::group([], function () {
            Route::post('login', 'AuthController@postLogin');
        });

        // 需要验证token的api
        Route::group(['middleware' => 'auth.api'], function () {
            Route::post('logout', 'AuthController@postLogout');
        });
    });

    // 用户
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

        // 需要验证token的api
        Route::group(['middleware' => 'auth.api'], function () {
            Route::get('info', 'UserController@getInfo');
        });
    });
});