<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Results extends Model
{
    public static function getTests($id){
        return Results::join('exams','exams.id','=','results.exam_id')->select('results.exam_id','exams.name')->where('user_id','=',$id)->groupby('exam_id')->get();
    }
    public static function getAnswers($userid,$testId){
        $Answers = DB::select('SELECT questions.question_number, questions.question_title, questions.answer_list, questions.answer_correct,results.question_id, results.Answer FROM results INNER JOIN questions ON questions.exam_id=exam_id AND questions.id=question_id WHERE results.exam_id='.$testId.' AND results.user_id='.$userid.' ');
        return $Answers;
    }
}

