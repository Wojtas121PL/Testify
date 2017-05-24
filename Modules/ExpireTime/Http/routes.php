<?php
Route::group(['middleware' => ['web','role:1'], 'prefix' => 'expiretime', 'namespace' => 'Modules\ExpireTime\Http\Controllers'], function()
{
    Route::get('/','ExpireTimeController@getListUserAndTime');

    Route::get('/add/','ExpireTimeController@addNewAndView');
    Route::post('/add','ExpireTimeController@addNewExpireTime');

    Route::get('/edit/','ExpireTimeController@getViewEdit');
    Route::post('/edit','ExpireTimeController@editSendToBase');

    Route::get('/delete/{id}/','ExpireTimeController@deleteTime');
});