<?php

// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
        Route::get('captcha', 'AuthController@getCaptcha');
        Route::get('password/email', 'AuthController@getPasswordEmail');
        Route::post('password/email', 'AuthController@postPasswordEmail');
        Route::get('password/reset', 'AuthController@getPasswordReset');
        Route::post('password/reset', 'AuthController@postPasswordReset');
    });


    Route::group(['middleware' => 'auth.admin'], function () {

        Route::get('', function () {
            return redirect(url('/admin/index'));
        });

        // index
        Route::group(['prefix' => 'index'], function () {
            Route::get('', 'IndexController@getIndex');
        });

        // error
        Route::group(['prefix' => 'error'], function () {
            Route::get('{id}', 'ErrorController@get');
        });

        // self
        Route::group(['prefix' => 'self'], function () {
            Route::get('info', 'SelfController@getInfo');
            Route::post('info', 'SelfController@postInfo');
            Route::get('password', 'SelfController@getPassword');
            Route::post('password', 'SelfController@postPassword');
        });

        // user
        Route::group(['prefix' => 'user'], function () {
            Route::get('', 'UserController@getIndex');
            Route::get('lists', 'UserController@getLists');

            Route::post('', 'UserController@post');
            Route::put('', 'UserController@put');
            Route::delete('', 'UserController@delete');
        });

        // admin
        Route::group(['prefix' => 'admin'], function () {
            Route::get('', 'AdminController@getIndex');
            Route::get('lists', 'AdminController@getLists');

            Route::post('', 'AdminController@post');
            Route::put('', 'AdminController@put');
            Route::delete('', 'AdminController@delete');
        });

        // 文件
        Route::group(['prefix' => 'file'], function () {

            // 图片
            Route::group(['prefix' => 'image'], function () {
                Route::get('', 'ImageController@getIndex');
                Route::get('lists', 'ImageController@getLists');
                Route::post('upload', 'ImageController@uploadImage');
                Route::delete('', 'ImageController@delete');
            });
        });

        // 系统
        Route::group(['prefix' => 'system'], function () {

            // 日志
            Route::group(['prefix' => 'log'], function () {

                // 用户日志
                Route::group(['prefix' => 'user'], function () {
                    Route::get('', 'LogController@getUser');
                    Route::get('lists', 'LogController@getLists');
                });

                // 错误日志
                Route::group(['prefix' => 'error'], function () {
                    Route::get('', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
                });
            });
        });

        // 组件示例(供参考,可删除)
        Route::group(['prefix' => 'example'], function () {
            Route::get('', 'ExampleController@getIndex');
        });
    });
});
