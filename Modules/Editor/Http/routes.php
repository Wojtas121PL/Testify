<?php

Route::group(['middleware' => 'web', 'prefix' => 'editor', 'namespace' => 'Modules\Editor\Http\Controllers'], function() {
    Route::get('/', 'EditorController@editorIndex');
    Route::group(['prefix' => 'exam'],function (){

    Route::get('/', 'EditorController@editorShow');
    Route::get('/{id}', 'EditorController@editorEdit');
    Route::get('/edit/{id}', 'EditorController@editorEditExam')->name('admin.exam.edit');
    });
    Route::get('edit/', 'EditorController@editorIndex');
    Route::get('edit/{id}', 'EditorController@editorIndex');

    Route::group(['prefix' => 'expiretime'],function (){
    Route::get('/', 'EditorController@editorGetListUserAndTime');

    Route::get('/add/', 'EditorController@editorAddNewAndView');
    Route::post('/add', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@addNewExpireTime');

    Route::get('/edit/', 'EditorController@editorGetViewEdit');
    Route::post('/edit', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@editSendToBase');

    Route::get('/delete/{id}/', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@deleteTime');
    });
});
