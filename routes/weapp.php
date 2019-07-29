<?php

Route::group(['prefix' => 'weapp', 'namespace' => 'WeApp'], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/login', 'UserController@login');
    });

});

