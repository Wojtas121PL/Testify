<?php

Route::group(['middleware' => 'web', 'prefix' => 'groupmanager', 'namespace' => 'Modules\GroupManager\Http\Controllers'], function() {
    Route::get('/', 'GroupManagerController@index');

    Route::get('/add', 'GroupManagerController@addGroupView')->name('add.groupAndUsers');
    Route::post('/add', 'GroupManagerController@store')->name('storeGroup');

    Route::get('/edit/{id}', 'GroupManagerController@edit')->name('edit');
    Route::post('/edit/confirm', 'GroupManagerController@saveToGroup')->name('editGroup');

    Route::get('/edit/delete/{id}', 'GroupManagerController@destroy')->name('deleteGroup');

    Route::post('/edit/changeName/{id}', 'GroupManagerController@update')->name('update');
});
