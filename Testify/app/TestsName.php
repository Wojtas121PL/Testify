<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class TestsName extends Model
{
    public function Test(){
        $this->belongsTo('tests');
    }

    public static function getTestNameList(){
        $Tests = array();
        foreach(TestsName::all() as $test){
            array_push($Tests, $test->Name);
        }
        return $Tests;
    }
}
