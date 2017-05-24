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

Route::group(['middleware' => ['web', 'role:2'], 'prefix' => 'admin', 'namespace' => 'Modules\Editor\Http\Controllers'], function()
{
    Route::get('/', 'EditorController@editorIndex');


    Route::get('exam', 'EditorController@editorShow');
    Route::get('exam/{id}', 'EditorController@editorEdit');
    Route::get('exam/edit/{id}', 'EditorController@editorEditExam')->name('admin.exam.edit');

    Route::get('edit/', 'EditorController@editorIndex');
    Route::get('edit/{id}', 'EditorController@editorIndex');

});