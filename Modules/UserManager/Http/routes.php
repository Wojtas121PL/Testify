<?php

Route::group(['middleware' => 'web', 'prefix' => 'usermanager', 'namespace' => 'Modules\UserManager\Http\Controllers'], function() {
        Route::get('/', 'UserManagerController@index');

        Route::get('/addUser', function () {
            return view('usermanager::settingUser.addUser');
        });

        Route::post('/addUser', 'UserManagerController@store');

        Route::get('/deleteUser', 'UserManagerController@getUserListToDelete');
        Route::get('deleteUser/{id}', 'UserManagerController@destroy');

        Route::get('/changePwd', 'UserManagerController@getUserListToChangePwd');
        Route::post('changePwd', 'UserManagerController@changePassword');

        Route::get('/changeEmail', 'UserManagerController@getUserListToChangeEmail');
        Route::post('changeEmail', 'UserManagerController@changeEmail');
    });
