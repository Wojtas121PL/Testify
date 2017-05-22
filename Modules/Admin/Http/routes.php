<?php

Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminController@index');


    Route::get('exam', 'AdminController@show');
    Route::get('exam/{id}', 'AdminController@edit');
    Route::post('exam/edit/{id}', 'AdminController@editExam')->name('admin.exam.edit');

    Route::get('edit/', 'AdminController@index');
    Route::get('edit/{id}', 'AdminController@index');



    Route::get('/result','ResultsController@getUserListAndViews');
    Route::get('/result/{userId}/{testId}','ResultsController@getAnswerByTestId');
    Route::post('result','ResultsController@getTestsByUserId');

});
