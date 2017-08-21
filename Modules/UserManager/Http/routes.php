<?php

Route::group(['middleware' => ['web','role:1'], 'prefix' => 'usermanager', 'namespace' => 'Modules\UserManager\Http\Controllers'], function() {
        Route::get('/', 'UserManagerController@getListUser')->name('user.manager.index');

        Route::get('/addUser','UserManagerController@create')->name('user.manager.add.user.show');
        Route::post('/addUser', 'UserManagerController@store')->name('user.manager.add.user.action');


        Route::get('/edit/{id}', 'UserManagerController@goToUser')->name('user.manager.edit.user.show');
        Route::post('/edit/{id}', 'UserManagerController@change')->name('user.manager.edit.user.action');

        Route::get('/disable/{id}','UserManagerController@destroy')->name('user.manager.disable');
        Route::get('/delete/{id}','UserManagerController@delete')->name('user.manager.delete');
    });
