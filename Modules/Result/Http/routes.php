<?php

Route::group(['middleware' => 'web', 'prefix' => 'result', 'namespace' => 'Modules\Result\Http\Controllers'], function()
{
    Route::post('/save','ResultsController@saveToDatabase')->name('results.save');
    Route::post('/saveProgressive','ResultsController@saveToDatabaseProgressive');
});

Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'result/admin', 'namespace' => 'Modules\Result\Http\Controllers'], function()
{
    Route::get('/','ResultsController@getUserListAndViews');
    Route::get('{userId}/{testId}','ResultsController@getAnswerByTestId');
    Route::post('/','ResultsController@getTestsByUserId');
});

