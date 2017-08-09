<?php

Route::group(['middleware' => 'web', 'prefix' => 'groupmanager', 'namespace' => 'Modules\GroupManager\Http\Controllers'], function()
{
    Route::get('/','GroupManagerController@index');
    Route::get('/add', 'GroupManagerController@addGroup')->name('add.groupAndUsers');
    Route::post('/add','GroupManagerController@store')->name('storeGroup');
});
