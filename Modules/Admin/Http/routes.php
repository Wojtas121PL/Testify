<?php

Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index');
});
