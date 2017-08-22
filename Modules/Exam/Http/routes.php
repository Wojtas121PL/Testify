<?php

Route::group(['middleware' => ['web', 'role:1','auth'], 'namespace' => 'Modules\Exam\Http\Controllers'], function()
{
    Route::resource('exam', 'ExamController');
    Route::resource('question', 'QuestionController');
    Route::post('questionOpen', 'QuestionController@storeOpen')->name('question.store.open');
    Route::post('saveUsers','ExamController@saveUsers')->name('saveUsers.exam');
    Route::post('questionMultiCheck', 'QuestionController@storeMultiCheck')->name('question.store.multiCheck');
    Route::post('exam/{id}/settings', 'ExamController@saveSettings')->name('exam.save.settings');
});
//
//Route::group(['middleware' => ['web', 'role:1'], 'prefix' => 'examWrite', 'namespace' => 'Modules\Exam\Http\Controllers'], function()
//{
//    Route::get('exam', 'Admin\AdminExamController');
//    Route::get('exam/{id}', 'Admin\AdminExamController@performExam');
//    Route::get('edit/', 'Admin\AdminExamController@editList');
//    Route::get('edit/{id}', 'Admin\AdminExamController@editExam');
//
//    Route::post('editQuestion', 'Admin\AdminEditController@editQuestion');
//    Route::post('editExam', 'Admin\AdminEditController@editExam');
//
//    Route::post('addExam', 'Admin\AdminEditController@addExam');
//    Route::post('addQuestion/{id}', 'Admin\AdminEditController@addQuestion');
//    Route::post('saveQuestion/{id}', 'Admin\AdminEditController@saveQuestion');
//
//    Route::get('/result','ResultController@getUserListAndViews');
//    Route::get('/result/{userId}/{testId}','ResultController@getAnswerByTestId');
//    Route::post('result','ResultController@getTestsByUserId');
//});