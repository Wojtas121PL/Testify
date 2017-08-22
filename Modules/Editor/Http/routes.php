<?php

Route::group(['middleware' => ['web','role:2','auth'], 'prefix' => 'editor', 'namespace' => 'Modules\Editor\Http\Controllers'], function() {
    Route::get('/', 'EditorController@editorIndex')->name('editor.home');
    Route::group(['prefix' => 'exam'],function (){

        Route::get('/', 'EditorController@editorShow')->name('editor.exam.show');
        Route::get('/{id}', 'EditorController@editorEdit')->name('editor.exam.id');
        Route::get('/edit/{id}', 'EditorController@editorEditExam')->name('editor.exam.edit.id');
    });

    Route::group(['prefix' => 'expiretime'],function (){
        Route::get('/', 'EditorController@editorGetListUserAndTime')->name('editor.expire.index');

        Route::get('/add/', 'EditorController@editorAddNewAndView')->name('editor.expire.add.show');
        Route::post('/add', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@addNewExpireTime')->name('editor.expire.add.action');

        Route::get('/edit/', 'EditorController@editorGetViewEdit')->name('editor.expire.edit.show');
        Route::post('/edit', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@editSendToBase')->name('editor.expire.edit.action');

        Route::get('/delete/{id}/', '\Modules\ExpireTime\Http\Controllers\ExpireTimeController@deleteTime')->name('editor.expire.delete');
    });
});
