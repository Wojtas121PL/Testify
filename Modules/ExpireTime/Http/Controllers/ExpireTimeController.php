<?php

namespace Modules\ExpireTime\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Exam\Entities\Exam;
use \Modules\Exam\Entities\Expire;
use \Modules\User\Entities\User;
use \Modules\Exam\Entities\Groups;
use \Modules\ExpireTime\Http\Requests;
use Carbon\Carbon;

class ExpireTimeController extends Controller
{
//Method for Admin
    public function getListUserAndTime(){
        $userTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('users','users.id','=','expires.user_id')
            ->select('expires.id','users.name as user','exams.name','expireTime','email')
            ->get();
        $groupTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('groups','groups.id','=','expires.group_id')
            ->select('expires.id','groups.group_name','exams.name','expireTime')
            ->get();
        return view('expiretime::time',['userTime' => $userTime,'groupTime' => $groupTime]);
    }
    public function getViewEdit(){
        $Exam = Exam::select('*')->get();
        $Users = User::select('id','name','role')->get();
        $Groups = Groups::select('*')->get();
        $userTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('users','users.id','=','expires.user_id')
            ->select('expires.id','users.name as user','users.id as uid','exams.name','expireTime','email')
            ->get();
        $groupTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('groups','groups.id','=','expires.group_id')
            ->select('expires.id','groups.group_name','groups.id as gid','exams.name','expireTime')
            ->get();
        return view('expiretime::edit',['Exam' => $Exam, 'Users' => $Users,'userTime' => $userTime, 'Groups' => $Groups, 'groupTime' => $groupTime]);
    }
    public function addNewAndView()
    {
        $Exam = Exam::select('*')->get();
        $Users = User::select('id','name','role')->get();
        $Groups = Groups::select('*')->get();
        $now = Carbon::now()->format('Y-m-d\TH:i');
        return view('expiretime::add',['Exam' => $Exam, 'Users' => $Users,'Groups' => $Groups, 'now' => $now]);
    }
    public function addNewExpireTime(Requests\Time $request)
    {
        $expireExist = Expire::select('*')->get();
        global $counter;
        if ($request->user != null){
            foreach ($request->user as $i => $user) {
                $counter = 0;
                foreach ($expireExist as $item) {
                    if ($item->user_id == $i) {
                        $counter++;
                    }
                }
                if ($counter == 0) {
                    $expire = new Expire();
                    $expire->exam_id = $request->examId;
                    $expire->user_id = $i;
                    $expire->expireTime = $request->data;
                    $expire->save();
                }
            }
        }
        if ($request->group != null) {
            foreach ($request->group as $i => $group) {
                $counter = 0;
                foreach ($expireExist as $item) {
                    if ($item->group_id == $i) {
                        $counter++;
                    }
                }
                if ($counter == 0) {
                    $expire = new Expire();
                    $expire->exam_id = $request->examId;
                    $expire->group_id = $i;
                    $expire->expireTime = $request->data;
                    $expire->save();
                }
            }
        }
        return back()->with('done','yes');
        }
    public function deleteTime($id){
        Expire::where('id','=',$id)->delete();
        return back()->with('done','yes');
    }
    public function editSendToBase(Requests\EditTime $request){
        $counter = 0;
        if ($request->editsUser != null){
            foreach ($request->editsUser as $id => $item) {
                if ($item['data'] != null) {
                    Expire::where('id', '=', $id)->update(['user_id' => $item['user'], 'exam_id' => $item['exam'], 'expireTime' => $item['data']]);
                    $counter++;
                }
            }
        }
        if($request->editsGroup != null) {
            foreach ($request->editsGroup as $id => $item) {
                if ($item['data'] != null) {
                    Expire::where('id', '=', $id)->update(['group_id' => $item['group'], 'exam_id' => $item['exam'], 'expireTime' => $item['data']]);
                    $counter++;
                }
            }
        }
        if ($counter==0){
            return back()->with('done', 'nothing');
        }
        return back()->with('done', 'yes');
    }
}
