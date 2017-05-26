<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public static function getContentAnswer($id){
        return Answer::select('answer')->where('question_id','=',$id)->get();
    }
}
