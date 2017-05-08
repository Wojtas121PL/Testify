<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class tests extends Model
{
    public function Name(){
        $this->hasMany('TestsName');
    }
}
