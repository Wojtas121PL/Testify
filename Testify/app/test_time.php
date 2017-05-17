<?php

namespace Testify;

use Illuminate\Database\Eloquent\Model;

class test_time extends Model
{
    public static function getListUserAndTime(){
        return test_time::join('exams','exams.id','=','test_times.exam_id')
            ->join('users','users.id','=','test_times.user_id')
            ->select('test_times.id','users.name as user','exams.name','expireTime')
            ->get();
    }
    public static function deleteIt($id){
        return test_time::where('id','=',$id)->delete();
    }
    public static function forViewsExam(){
        return Exam::select('id','name')->get();
    }
    public static function forViewUser(){
        return User::select('id','name')->get();
    }
}
