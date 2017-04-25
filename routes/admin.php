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

        // error
        Route::group(['prefix' => 'error', 'namespace' => 'Error'], function () {
            Route::get('{id}', 'ErrorController@get');
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
                Route::get('', ['uses' => 'AccountController@getIndex', 'middleware' => 'permission.admin:getAdminAccount', 'as' => 'getAdminAccount']);
                Route::get('lists', ['uses' => 'AccountController@getLists', 'as' => 'getAdminAccountLists']);

                Route::post('', ['uses' => 'AccountController@post', 'middleware' => 'permission.admin:createAdminAccount', 'as' => 'createAdminAccount']);
                Route::put('', ['uses' => 'AccountController@put', 'middleware' => 'permission.admin:updateAdminAccount', 'as' => 'updateAdminAccount']);
                Route::delete('', ['uses' => 'AccountController@delete', 'middleware' => 'permission.admin:deleteAdminAccount', 'as' => 'deleteAdminAccount']);
            });

            // role
            Route::group(['prefix' => 'role'], function () {
                Route::get('', ['uses' => 'RoleController@getIndex', 'middleware' => 'permission.admin:getAdminRole', 'as' => 'getAdminRole']);
                Route::get('lists', ['uses' => 'RoleController@getLists', 'as' => 'getAdminRoleLists']);

                Route::post('', ['uses' => 'RoleController@post', 'middleware' => 'permission.admin:createAdminRole', 'as' => 'createAdminRole']);
                Route::put('', ['uses' => 'RoleController@put', 'middleware' => 'permission.admin:updateAdminRole', 'as' => 'updateAdminRole']);
                Route::delete('', ['uses' => 'RoleController@post', 'middleware' => 'permission.admin:deleteAdminRole', 'as' => 'deleteAdminRole']);
                Route::put('permission', ['uses' => 'RoleController@putPermission', 'middleware' => 'permission.admin:updateAdminPermission', 'as' => 'updateAdminPermission']);
            });


        });

        // 文件
        Route::group(['prefix' => 'file', 'namespace' => 'File'], function () {

            // 图片
            Route::group(['prefix' => 'image'], function () {
                Route::get('', ['uses' => 'ImageController@getIndex', 'middleware' => 'permission.admin:getImage', 'as' => 'getImage']);
                Route::get('lists', 'ImageController@getLists')->name('getImageLists');
                Route::post('upload', ['uses' => 'ImageController@uploadImage', 'middleware' => 'permission.admin:uploadImage', 'as' => 'uploadImage']);
            });
        });

        // 系统
        Route::group(['prefix' => 'system', 'namespace' => 'System'], function () {

            // 日志
            Route::group(['prefix' => 'log'], function () {

                // 用户日志
                Route::group(['prefix' => 'user'], function () {
                    Route::get('', ['uses' => 'LogController@getUser', 'middleware' => 'permission.admin:getUserLog', 'as' => 'getUserLog']);
                    Route::get('lists', 'LogController@getLists')->name('getUserLogLists');
                });

                // 错误日志
                Route::group(['prefix' => 'error'], function () {
                    Route::get('', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
                });
            });
        });

        // 组件示例(供参考,可删除)
        Route::group(['prefix' => 'example', 'namespace' => 'Example'], function () {
            Route::get('', 'ExampleController@getIndex');
        });
    });
});
