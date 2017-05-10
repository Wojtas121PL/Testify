<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    public function testsName(){
        return $this->belongsTo('Testify\TestsName');
    }

    public static function getTestById($id){
        return tests::where('TestId', '=', $id)->get();
    }

    public static function addNewQuestion($request){
        tests::insert($request);

    }
}
