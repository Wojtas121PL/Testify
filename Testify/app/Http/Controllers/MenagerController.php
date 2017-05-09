<?php

namespace Testify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Testify\Http\Requests\TestCreator;
use Testify\tests;

class MenagerController extends Controller
{
    public function addQuestion (TestCreator $request) {
        $data = [
            'TestId'    =>  $request->TestId,
            'QuestionId'    =>  $request->QuestionId,
            'QuestionType'    =>  $request->QuestionType,
            'Question'    =>  $request->Question,
            'Answers'    =>  json_encode([
                1 => $request->Answer1,
                2 => $request->Answer2,
                3 => $request->Answer3,
                4 => $request->Answer4,
            ]),
            'AnswerKey'    =>  $request->AnswerKey
        ];
        tests::addNewQuestion($data);
        \Redirect('/home');
    }
    public function formQuestion(){
        return view('addNew');
    }
}
