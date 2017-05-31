<?php

Route::group(['middleware' => ['web','role:1'], 'prefix' => 'usermanager', 'namespace' => 'Modules\UserManager\Http\Controllers'], function() {
        Route::get('/', 'UserManagerController@getListUser');

        Route::get('/addUser', function () {
            return view('usermanager::settingUser.addUser');
        });

        Route::post('/addUser', 'UserManagerController@store');
        Route::get('/edit/{id}', 'UserManagerController@goToUser');
    });
