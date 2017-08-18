<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static function getAnswerContent(){
        return Question::join('answers','answers.question_id','=','questions.id')->get();
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
