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

        // 首页
        Route::group(['prefix' => 'index'], function () {
            Route::get('', 'IndexController@getIndex');
        });

        // 错误页
        Route::group(['prefix' => 'error'], function () {
            Route::get('{id}', 'ErrorController@get');
        });

        // 个人中心
        Route::group(['prefix' => 'self'], function () {
            Route::get('info', 'SelfController@getInfo');
            Route::post('info', 'SelfController@postInfo');
            Route::get('password', 'SelfController@getPassword');
            Route::post('password', 'SelfController@postPassword');
        });

        // 前台用户
        Route::group(['prefix' => 'user'], function () {
            Route::get('', 'UserController@getIndex');
            Route::get('lists', 'UserController@getLists');

            Route::post('', 'UserController@post');
            Route::put('', 'UserController@put');
            Route::delete('', 'UserController@delete');
        });

        // 后台账户
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

        // 短信
        Route::group(['prefix' => 'sms'], function () {
            Route::get('send', 'SmsController@send');
        });

        // 系统
        Route::group(['prefix' => 'system'], function () {
            Route::group(['prefix' => 'config'], function(){
                Route::get('','SystemConfigController@getIndex');
                Route::get('lists', 'SystemConfigController@getLists');
                Route::post('', 'SystemConfigController@post');
                Route::put('', 'SystemConfigController@put');
                Route::delete('', 'SystemConfigController@delete');
            });

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

        //微信配置
        Route::group(['prefix' => 'wechat'], function () {
            Route::group(['prefix' => 'menu'], function () {
                Route::get('', 'WeChatMenuController@getIndex');
                Route::get('lists', 'WeChatMenuController@getLists');
                Route::post('', 'WeChatMenuController@post');
                Route::put('', 'WeChatMenuController@put');
                Route::delete('', 'WeChatMenuController@delete');

                Route::post('sub', 'WeChatMenuController@subAdd');
                Route::put('sub', 'WeChatMenuController@subPut');
                Route::delete('sub', 'WeChatMenuController@subDelete');
            });

            Route::group(['prefix' => 'reply'], function () {
                Route::get('{type}', 'WeChatReplyController@getIndex');
                Route::get('lists/{type}', 'WeChatReplyController@getLists');
                Route::post('text', 'WeChatReplyController@textAdd');
                Route::put('text', 'WeChatReplyController@textEdit');
                Route::post('news', 'WeChatReplyController@post');
                Route::put('news', 'WeChatReplyController@put');
                Route::delete('', 'WeChatReplyController@delete');
                Route::post('uploadImage', ['uses' => 'WeChatReplyController@uploadImage']);
            });

        });

        // 组件示例(供参考,可删除)
        Route::group(['prefix' => 'example'], function () {
            Route::get('', 'ExampleController@getIndex');
        });
    });
});
