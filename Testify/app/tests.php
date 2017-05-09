<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    public function Name(){
        $this->hasMany('TestsName');
    }

    public static function getTestById($id){
        return tests::where('TestId', '=', $id)->get();
    }
}
