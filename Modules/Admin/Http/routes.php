<?php

Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index');


    Route::get('exam', 'AdminController@show');
    Route::get('exam/{id}', 'AdminController@edit');
    Route::get('exam/edit/{id}', 'AdminController@editExam')->name('admin.exam.edit');

    Route::get('edit/', 'AdminController@index');
    Route::get('edit/{id}', 'AdminController@index');

});
