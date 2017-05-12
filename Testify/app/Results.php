<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;
class Results extends Model
{
    public static function getAnswers($userid){
        return Exam::join('results', 'results.TestId', '=', 'exams.id')
            ->join('users','users.id' ,'=', 'results.UserId')
            ->select('users.name', 'exams.name as ExamName','results.QuestionId','results.Answer','results.CorrectAnswer')
            ->where('users.id','=',$userid)
            ->get();
    }
}