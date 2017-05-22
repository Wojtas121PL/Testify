<?php

namespace Modules\ExpireTime\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Exam\Entities;
use \Modules\ExpireTime\Http\Requests;
class ExpireTimeController extends Controller
{
//Method for Admin
    public function getListUserAndTime(){
        $userTime = Entities\Expire::getListUserAndTime();
        return view('expiretime::time',['userTime' => $userTime]);
    }
    public function getViewEdit(){
        $exam = Entities\Expire::forViewsExam();
        $user = Entities\Expire::forViewUser();
        $userTime = Entities\Expire::getListUserAndTime();
        return view('expiretime::edit',['Exam' => $exam, 'Users' => $user,'userTime' => $userTime]);
    }
    public function deleteTime($id){
        Entities\Expire::deleteIt($id);
        return back()->with('done','yes');
    }
    public function addNewAndView(){
        $exam = Entities\Expire::forViewsExam();
        $user = Entities\Expire::forViewUser();
        return view('expiretime::add',['Exam' => $exam, 'Users' => $user]);
    }
    public function addNewExpireTime(Requests\Time $time){
        $record = new Entities\Expire;
        $record->exam_id = $time->examId;
        $record->user_id = $time->userId;
        $record->expireTime = $time->data;
        $record->save();
        return back()->with('done','yes');
    }
    public function editSendToBase(Requests\EditTime $editTime){
        $counter = 0;
        foreach($editTime->edits as $id => $item) {
            if ($item['data'] != null) {
                Entities\Expire::where('id','=',$id)->update(['user_id' => $item['user'],'exam_id' => $item['exam'],'expireTime' => $item['data']]);
                $counter++;
            }
            if ($counter==0){
                return back()->with('done', 'nothing');
            }
        }
        return back()->with('done', 'yes');
    }
}
