<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public static function getContentQuestion($id){
        return Exam::join('questions','questions.exam_id','=','exams.id')->where('exams.id','=',$id)->get();
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
