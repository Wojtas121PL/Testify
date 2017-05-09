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
    Route::get('/addNew', function (){
        return view('addNew');
    });
    Route::post('addQuesion', 'MenagerController@addQuestion');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
