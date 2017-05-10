<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
