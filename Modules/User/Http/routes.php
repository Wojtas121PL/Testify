<?php

Route::group(['middleware' => ['web', 'role:3'], 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
    Route::get('/list', 'UserController@examList');
    Route::get('/exam/{id}', 'UserController@exam');


    Route::get('/test', function() {
        return view('user::test');
    });
});
