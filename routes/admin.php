<?php

// admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // auth
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('login', 'AuthController@getLogin');
        Route::post('login', 'AuthController@postLogin');
        Route::get('logout', 'AuthController@getLogout');
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

        // self
        Route::group(['prefix' => 'self', 'namespace' => 'Self'], function () {
            Route::get('info', 'SelfController@getInfo');
            Route::post('info', 'SelfController@postInfo');
            Route::get('password', 'SelfController@getPassword');
            Route::post('password', 'SelfController@postPassword');
        });

        // user
        Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
            Route::get('', 'UserController@getIndex');
            Route::get('lists', 'UserController@getLists');

            Route::post('', 'UserController@post');
            Route::put('', 'UserController@put');
            Route::delete('', 'UserController@delete');
        });

        // admin
        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

            // account
            Route::group(['prefix' => 'account'], function () {
                Route::get('', 'AccountController@getIndex');
                Route::get('lists', 'AccountController@getLists')->name('getAdminAccountLists');

                Route::post('', 'AccountController@post')->name('createAdminAccount');
                Route::put('', 'AccountController@put')->name('updateAdminAccount');
                Route::delete('', 'AccountController@delete')->name('deleteAdminAccount');
            });

            // role
            Route::group(['prefix' => 'role'], function () {
                Route::get('', 'RoleController@getIndex');
                Route::get('lists', 'RoleController@getLists')->name('getAdminRoleLists');

                Route::post('', 'RoleController@post')->name('createAdminRole');
                Route::put('', 'RoleController@put')->name('updateAdminRole');
                Route::delete('', 'RoleController@delete')->name('deleteAdminRole');
            });


        });


        // system
        Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {

            // log
            Route::group(['prefix' => 'log'], function () {
                Route::get('', 'LogController@getIndex');
                Route::get('lists', 'LogController@getLists')->name('getSystemLogLists');
            });
        });
    });
});
