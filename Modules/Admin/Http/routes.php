<?php

Route::group(['middleware' => ['web', 'role:1','auth'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('exam', 'AdminController@show')->name('admin.show');
    Route::get('exam/{id}', 'AdminController@edit')->name('admin.exam.id');
    Route::get('exam/edit/{id}', 'AdminController@editExam')->name('admin.exam.edit.id');
});
