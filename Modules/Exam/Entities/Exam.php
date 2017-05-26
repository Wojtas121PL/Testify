<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
