<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Exam\Entities\Result;

class Results extends Model
{
    public static function getTests($id){
        return Results::join('exams','exams.id','=','results.exam_id')->select('results.exam_id','exams.name')->where('user_id','=',$id)->groupby('exam_id', 'testify.exams.name')->get();
    }
    public static function getAnswers($userid,$testId){
        $Answers = DB::select('SELECT questions.question_number,questions.question_type, questions.question_title, questions.answer_correct,questions.answer_correct_text,results.question_id, results.answer_int,results.answer_text FROM results INNER JOIN questions ON questions.exam_id=results.exam_id AND questions.id=question_id WHERE results.exam_id='.$testId.' AND results.user_id='.$userid.' ');
        return $Answers;
    }
    public static function getAnswersToResult($testId){
        $typeAnswer = Result::join('answers','answers.question_id','=','results.question_id')->where('results.exam_id','=',$testId)->get();
        return $typeAnswer;
    }
}

