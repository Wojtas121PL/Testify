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
Route::group( ['middleware' => 'role:3' , 'prefix' => 'user'], function()
{
    Route::get('exam', 'User\ExamController');
    Route::get('exam/{id}', 'User\ExamController@performExam');


});
//EDITOR GROUP

//ADMIN GROUP
Route::group( ['middleware' => 'role:1', 'prefix' => 'admin'], function()
{
    Route::get('exam', 'Admin\AdminExamController');
    Route::get('exam/{id}', 'Admin\AdminExamController@performExam');
    Route::get('exam/edit/{id}', 'Admin\AdminExamController@editExam');
    Route::get('/result','ResultController@getUserListAndViews');
    Route::post('result','ResultController@getAnswersByUserId');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
