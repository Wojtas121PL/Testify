<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
