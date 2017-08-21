<?php
Route::group(['middleware' => ['web','auth'], 'prefix' => 'expiretime', 'namespace' => 'Modules\ExpireTime\Http\Controllers'], function()
{
    Route::get('/','ExpireTimeController@getListUserAndTime')->name('admin.expire.index');

    Route::get('/add/','ExpireTimeController@addNewAndView')->name('admin.expire.add.show');
    Route::post('/add','ExpireTimeController@addNewExpireTime')->name('admin.expire.add.action');

    Route::get('/edit/','ExpireTimeController@getViewEdit')->name('admin.expire.edit.show');
    Route::post('/edit','ExpireTimeController@editSendToBase')->name('admin.expire.edit.action');

    Route::get('/delete/{id}/','ExpireTimeController@deleteTime')->name('admin.expire.delete');
});