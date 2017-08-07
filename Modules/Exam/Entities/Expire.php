<?php

namespace Modules\Exam\Entities;

use Illuminate\Database\Eloquent\Model;
use \Modules\Exam;
use \Modules\User;

class Expire extends Model
{
    protected $fillable = [];
    public static function getListUserAndTime(){
        return Exam\Entities\Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('users','users.id','=','expires.user_id')
            ->select('expires.id','users.name as user','exams.name','expireTime','email')
            ->get();
    }
    public static function deleteIt($id){
        return Exam\Entities\Expire::where('id','=',$id)->delete();
    }
    public static function forViewsExam(){
        return Exam\Entities\Exam::select('id','name')->get();
    }
    public static function forViewUser(){
        return User\Entities\User::select('id','name')->get();
    }
}
