<?php

Route::group(['middleware' => ['web', 'role:3','auth'], 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/list', 'UserController@examList')->name('user.exam.list');
    Route::get('/exam/{id}', 'UserController@exam')->name('user.exam.action');
    Route::get('/exam/{id}/rules', 'UserController@beforeExam')->name('user.exam.rules');


    Route::get('/exam/{id}/{question}', 'UserController@examProgressive')->name('user.exam.progressive.test.question');

});
