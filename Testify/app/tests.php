<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    public function Name(){
        $this->hasMany('TestsName');
    }

    public static function getTestById($id){
        return tests::where('TestId', '=', $id)->get();
    }

    public static function addNewQuestion($request){
        tests::insert([
            'TestId'    =>  $request->TestId,
            'QuestionId'    =>  $request->QuestionId,
            'QuestionType'    =>  $request->QuestionType,
            'Question'    =>  $request->Question,
            'Answers'    =>  $request->Answers,
            'AnswerKey'    =>  $request->AnswerKey
        ]);

    }
}
