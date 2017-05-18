<?php

Route::group(['middleware' => 'web', 'prefix' => 'exam', 'namespace' => 'Modules\Exam\Http\Controllers'], function()
{
    Route::get('/', 'ExamController@index');
});
