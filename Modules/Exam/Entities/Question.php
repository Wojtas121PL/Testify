<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
