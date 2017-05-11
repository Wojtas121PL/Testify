<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;
// SELECT users.name, exams.name,results.QuestionId,results.Answer,results.CorrectAnswer FROM `exams`
// INNER JOIN `results` ON results.TestId = exams.id INNER JOIN `users` ON users.id = results.UserId WHERE users.id=$userid
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