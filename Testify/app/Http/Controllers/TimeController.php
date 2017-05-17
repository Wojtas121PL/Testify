<?php

namespace Testify\Http\Controllers;

use Testify\Http\Requests\Admin\EditTime;
use Testify\test_time;
use Testify\Http\Requests\Admin\Time;
class TimeController extends Controller
{
//Method for Admin
    public function getListUserAndTime(){
        $userTime = test_time::getListUserAndTime();
        return view('admin.time.time',['userTime' => $userTime]);
    }
    public function getViewEdit(){
        $exam = test_time::forViewsExam();
        $user = test_time::forViewUser();
        $userTime = test_time::getListUserAndTime();
        return view('admin.time.edit',['Exam' => $exam, 'Users' => $user,'userTime' => $userTime]);
    }
    public function deleteTime($id){
        test_time::deleteIt($id);
        return redirect('/admin/time/')->with('done','yes');
    }
    public function addNewAndView(){
        $exam = test_time::forViewsExam();
        $user = test_time::forViewUser();
        return view('admin.time.add',['Exam' => $exam, 'Users' => $user]);
    }
    public function addNewExpireTime(Time $time){
        $record = new test_time;
        $record->exam_id = $time->examId;
        $record->user_id = $time->userId;
        $record->expireTime = $time->data;
        $record->save();
        return redirect('/admin/time/add')->with('done','yes');
    }
    public function editSendToBase(EditTime $editTime){
        $counter = 0;
        foreach($editTime->edits as $id => $item) {
            if ($item['data'] != null) {
                test_time::where('id','=',$id)->update(['user_id' => $item['user'],'exam_id' => $item['exam'],'expireTime' => $item['data']]);
                $counter++;
            }
            if ($counter==0){
                return redirect('/admin/time/edit')->with('done', 'nothing');
            }
        }
        return redirect('/admin/time/edit')->with('done', 'yes');
    }
//Method for User
}
