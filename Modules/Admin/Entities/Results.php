<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Results extends Model
{
    public static function getTests($id){
        return Results::join('exams','exams.id','=','results.TestId')->select('results.TestId','exams.name')->where('UserId','=',$id)->groupby('testId')->get();
    }
    public static function getAnswers($userid,$testId){
        $Answers = DB::select('SELECT questions.question_number, questions.question_title, questions.answer_list, questions.answer_correct,results.QuestionId, results.Answer FROM results INNER JOIN questions ON questions.exam_id=TestId AND questions.id=QuestionId WHERE results.TestId='.$testId.' AND results.UserId='.$userid.' ');
        return $Answers;
    }
}

