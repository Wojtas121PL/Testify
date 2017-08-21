<?php

Route::group(['middleware' => 'web', 'prefix' => 'result', 'namespace' => 'Modules\Result\Http\Controllers'], function()
{
    Route::post('/save','ResultsController@saveToDatabase')->name('results.save');
    Route::post('/saveProgressive','ResultsController@saveToDatabaseProgressive')->name('results.progressive.save');
});

Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'result/admin', 'namespace' => 'Modules\Result\Http\Controllers'], function()
{
    Route::get('/','ResultsController@getUserListAndViews')->name('results.admin.index');
    Route::get('{userId}/{testId}','ResultsController@getAnswerByTestId')->name('results.admin.userId.TestId.show');
    Route::post('/','ResultsController@getTestsByUserId')->name('results.admin.test.action');
});

