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

Route::get('/home', 'HomeController@index')->name('home');


//USER GROUP
Route::group( ['middleware' => ['auth', 'role:3'] , 'prefix' => 'user'], function()
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

    Route::post('editQuestion', 'Admin\AdminEditController@editQuestion');
    Route::post('editExam', 'Admin\AdminEditController@editExam');

    Route::post('addExam', 'Admin\AdminEditController@addExam');
    Route::post('addQuestion/{id}', 'Admin\AdminEditController@addQuestion');
    Route::post('saveQuestion/{id}', 'Admin\AdminEditController@saveQuestion');

    Route::get('/result','ResultController@getUserListAndViews');
    Route::post('result','ResultController@getAnswersByUserId');
});

Auth::routes();

