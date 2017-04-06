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
        Route::post('password/reset', 'AuthController@postPasswordReset');
    });


    Route::group(['middleware' => 'auth.admin:admin'], function () {

        Route::get('', function () {
            return redirect(url('/admin/index'));
        });

        // index
        Route::group(['prefix' => 'index'], function () {
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

        // self
        Route::group(['prefix' => 'self'], function () {
            Route::get('info', 'SelfController@getInfo');
            Route::post('info', 'SelfController@postInfo');
            Route::get('password', 'SelfController@getPassword');
            Route::post('password', 'SelfController@postPassword');
        });

        // admin role
        Route::group(['prefix' => 'adminrole'], function () {
            Route::get('', 'AdminRoleController@getIndex');
            Route::get('lists', 'AdminRoleController@getLists');

            Route::post('', 'AdminRoleController@post');
            Route::put('', 'AdminRoleController@put');
            Route::delete('', 'AdminRoleController@delete');
        });
    });
});
