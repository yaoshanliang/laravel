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
        Route::put('password/reset', 'AuthController@putPasswordReset');
    });

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
