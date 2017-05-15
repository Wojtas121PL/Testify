<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('/master', function () {
        return view('layouts.master');
    });

    Route::get('/admin', function () {
        return view('admin');
    });
    Route::get('/list','ListController');
    Route::get('/test/{id}', ['uses' => 'TestController@create']);


    Route::post('addQuestion', 'MenagerController@addQuestion');
    Route::get('/addQuestion', ['uses' => 'MenagerController@formQuestion']);


});

//USER GROUP
Route::group( ['middleware' => 'auth' , 'prefix' => 'user'], function()
{
    Route::get('exam', 'User\ExamController');
    Route::get('exam/{id}', 'User\ExamController@performExam');


});
//EDITOR GROUP

//ADMIN GROUP
Route::group( ['middleware' => ['role:1', 'auth'], 'prefix' => 'admin'], function()
{
    Route::get('/', function (){
        return view('admin.home');
    });

    Route::get('exam', 'Admin\AdminExamController');
    Route::get('exam/{id}', 'Admin\AdminExamController@performExam');

    Route::get('edit/', 'Admin\AdminExamController@editList');
    Route::get('edit/{id}', 'Admin\AdminExamController@editExam');

    Route::post('deleteQuestion', 'Admin\AdminEditController@deleteQuestion');
    Route::post('deleteExam', 'Admin\AdminEditController@deleteExam');

    Route::post('addExam', 'Admin\AdminEditController@addExam');
    Route::post('addQuestion/{id}', 'Admin\AdminEditController@addQuestion');

    Route::get('/result','ResultController@getUserListAndViews');
    Route::get('/result/{userId}/{testId}','ResultController@getAnswerByTestId');
    Route::post('result','ResultController@getTestsByUserId');
Route::group(['prefix' => 'setting'],function ()
{
    Route::get('/','Admin\AdminSettingUserController@getListUser');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
