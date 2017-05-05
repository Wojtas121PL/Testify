<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    protected $fillable = array('TestId', 'QuestionId', 'QuestionType', 'Question', 'Answers', 'AnswerKey');
}
