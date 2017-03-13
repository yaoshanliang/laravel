<?php

// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
        Route::get('password/email', 'AuthController@getPasswordEmail');
        Route::post('password/email', 'AuthController@postPasswordEmail');
        Route::get('password/reset', 'AuthController@getPasswordReset');
        Route::post('password/reset', 'AuthController@putPasswordReset');

        //发送密码重置链接路由
        /*Route::get('/password/email', 'ForgotPasswordController@showLinkRequestForm');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        //密码重置路由
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm');
        Route::post('password/reset', 'ResetPasswordController@reset');*/
    });

/*    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
        //登陆
        Route::get('login', 'LoginController@showLoginForm');
        Route::post('login', 'LoginController@postLogin');
        Route::get('logout', 'LoginController@getLogout');
        //发送密码重置链接路由
        Route::get('password/email', 'ForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        //密码重置路由
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
        Route::post('password/reset', 'ResetPasswordController@reset');
    });*/

    Route::group(['middleware' => 'auth.admin:admin'], function () {

        // index
        Route::group(['prefix' => ''], function () {
            Route::get('', 'IndexController@getIndex');
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
    });
});
