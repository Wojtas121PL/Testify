<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    protected $fillable = array('TestId', 'QuestionId', 'QuestionType', 'Question', 'Answers', 'AnswerKey');

    public function Name(){
        $this->hasMany('Testify\TestsName');
    }
}
