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
Route::group(['middleware' => ['web','role:2'], 'prefix' => 'expiretime', 'namespace' => 'Modules\Editor\Http\Controllers'], function()
{
    Route::get('/','EditorController@editorGetListUserAndTime');

    Route::get('/add/','EditorController@editorAddNewAndView');
    Route::post('/add','\Modules\ExpireTime\Http\Controllers\ExpireTimeController@addNewExpireTime');

    Route::get('/edit/','EditorController@editorGetViewEdit');
    Route::post('/edit','\Modules\ExpireTime\Http\Controllers\ExpireTimeController@editSendToBase');

    Route::get('/delete/{id}/','\Modules\ExpireTime\Http\Controllers\ExpireTimeController@deleteTime');
});