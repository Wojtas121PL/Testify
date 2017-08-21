<?php

Route::group(['middleware' => ['web', 'role:3'], 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/list', 'UserController@examList')->name('user.exam.list');
    Route::get('/exam/{id}', 'UserController@exam')->name('user.exam.action');


    Route::get('/exam/{id}/{question}', 'UserController@examProgressive')->name('user.exam.progressive.test.question');
});
