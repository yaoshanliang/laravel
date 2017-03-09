<?php

// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
    });

    Route::group(['middleware' => 'auth.admin:admin'], function () {

        // index
        Route::group(['prefix' => ''], function () {
            Route::get('', 'IndexController@getIndex');
        });

        // user
        Route::group(['prefix' => 'user'], function () {
            Route::get('', 'UserController@getIndex');
        });

        // admin
        Route::group(['prefix' => 'admin'], function () {
            Route::get('', 'AdminController@getIndex');
        });
    });
});
