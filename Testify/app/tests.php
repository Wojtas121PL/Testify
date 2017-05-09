<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    public function NameOfTest(){
        $this->hasMany('TestsName');
    }

    public static function getTestById($id){
        return tests::where('TestId', '=', $id)->get();
    }

    public static function addNewQuestion($request){
        tests::insert($request);

    }
}
