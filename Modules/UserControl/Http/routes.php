<?php

Route::group(['middleware' => 'web', 'prefix' => 'usercontrol', 'namespace' => 'Modules\UserControl\Http\Controllers'], function()
{
    Route::get('/', 'UserControlController@index');
    Route::group(['prefix' => 'setting'],function ()
    {
        Route::get('/','UserController@getListUser');
        Route::get('/addUser',function (){
            return view('admin.settingUser.addUser');
        });
        Route::post('addUser','Admin\AdminSettingUserController@createUser');

        Route::get('/deleteUser','Admin\AdminSettingUserController@getUserListToDelete');
        Route::get('deleteUser/{id}','Admin\AdminSettingUserController@deleteUser');

        Route::get('/changePwd','Admin\AdminSettingUserController@getUserListToChangePwd');
        Route::post('changePwd','Admin\AdminSettingUserController@changePassword');

        Route::get('/changeEmail','Admin\AdminSettingUserController@getUserListToChangeEmail');
        Route::post('changeEmail','Admin\AdminSettingUserController@changeEmail');
    });
});
