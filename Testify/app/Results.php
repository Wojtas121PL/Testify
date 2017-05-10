<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    public static function getAnswers($userid){
        return Results::where('UserId','=',$userid)->get();
    }
}
