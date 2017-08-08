<?php

namespace Modules\Editor\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Exam\Entities;
use Carbon\Carbon;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamUser;
use Modules\Exam\Entities\Question;
use Modules\User\Entities\User;

class EditorController extends Controller
{
    //Method for editor from ExpireTime
    public function editorGetListUserAndTime(){
        $userTime = Entities\Expire::getListUserAndTime();
        return view('editor::time',['userTime' => $userTime]);
    }
    public function editorGetViewEdit(){
        $exam = Entities\Expire::forViewsExam();
        $user = Entities\Expire::forViewUser();
        $userTime = Entities\Expire::getListUserAndTime();
        return view('editor::edit',['Exam' => $exam, 'Users' => $user,'userTime' => $userTime]);
    }
    public function editorAddNewAndView(){
        $exam = Entities\Expire::forViewsExam();
        $user = Entities\Expire::forViewUser();

        $now = Carbon::now()->format('Y-m-d\TH:i');
        return view('editor::add',['Exam' => $exam, 'Users' => $user, 'now'=>$now]);
    }
    //Method for editor from Edit List
    public function editorIndex()
    {
        return view('editor::index');
    }
    public function editorShow(){
        $exams = Exam::all();
        return view('editor::exam.list', ['exams' => $exams]);
    }
    public function editorEdit($id){
        $exam = Exam::where('id', $id)->first();
        $UserBelongs = ExamUser::where('exam_id','=',$id)->get();
        $Users = User::select('id','name','role')->get();
        foreach ($Users as $user){
            $user->setAttribute('status','noBelong');
            $UserBelongs->each(function ($item) use ($user){
                if($user->id == $item->user_id){
                    $user->setAttribute('status', 'belong');
                }
            });
        }
        return view('editor::exam.exam', ['exam' => $exam, 'edit_id' => null,'Users' => $Users, 'UsersBelongs' => $UserBelongs]);
    }

    public function editorEditExam(Request $request, $id){
        $answer = Question::getAnswerContent();
        $exam = Exam::where('id', $id)->first();
        $UserBelongs = ExamUser::select('*')->where('exam_id','=',$id)->get();
        $Users = User::select('id','name','role')->get();
        foreach ($Users as $user){
            $user->setAttribute('status','noBelong');
            $UserBelongs->each(function ($item) use ($user){
                if($user->id == $item->user_id){
                    $user->setAttribute('status', 'belong');
                }
            });
        }
        return view('editor::exam.exam', ['exam' => $exam,'answer' =>$answer, 'edit_id' => $request->edit_id,'Users' => $Users, 'UsersBelongs' => $UserBelongs]);
    }
}
