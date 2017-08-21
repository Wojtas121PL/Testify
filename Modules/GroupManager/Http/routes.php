<?php

Route::group(['middleware' => 'web', 'prefix' => 'groupmanager', 'namespace' => 'Modules\GroupManager\Http\Controllers'], function() {
    Route::get('/', 'GroupManagerController@index')->name('group.index');

    Route::get('/add', 'GroupManagerController@addGroupView')->name('group.add.show');
    Route::post('/add', 'GroupManagerController@store')->name('group.add.action');

    Route::get('/edit/{id}', 'GroupManagerController@edit')->name('group.edit.id');
    Route::post('/edit/confirm', 'GroupManagerController@saveToGroup')->name('group.edit.action');

    Route::get('/edit/delete/{id}', 'GroupManagerController@destroy')->name('group.delete');

    Route::post('/edit/changeName/{id}', 'GroupManagerController@update')->name('group.update');
});
