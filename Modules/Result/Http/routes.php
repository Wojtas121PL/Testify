<?php

Route::group(['middleware' => 'web', 'prefix' => 'result', 'namespace' => 'Modules\Result\Http\Controllers'], function()
{
    Route::get('admin/','ResultsController@getUserListAndViews');
    Route::get('{userId}/{testId}','ResultsController@getAnswerByTestId');
    Route::post('admin/','ResultsController@getTestsByUserId');
    Route::post('/save','ResultsController@saveToDatabase');
});
