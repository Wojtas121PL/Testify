<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class TestsName extends Model
{
    public function Test(){
        $this->belongsTo('tests');
    }
}
