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
use Modules\Exam\Entities\Expire;
use Modules\Exam\Entities\Groups;
use Modules\User\Entities\User;

class EditorController extends Controller
{
    //Method for editor from ExpireTime
    public function editorGetListUserAndTime(){
        $userTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('users','users.id','=','expires.user_id')
            ->select('expires.id','users.name as user','exams.name','expireTime','email')
            ->get();
        $groupTime = Expire::join('exams','exams.id','=','expires.exam_id')
            ->join('groups','groups.id','=','expires.group_id')
            ->select('expires.id','groups.group_name','exams.name','expireTime')
            ->get();
        return view('editor::time',['userTime' => $userTime,'groupTime' => $groupTime]);
    }
    public function editorGetViewEdit(){
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
        return view('editor::edit',['Exam' => $Exam, 'Users' => $Users,'userTime' => $userTime, 'Groups' => $Groups, 'groupTime' => $groupTime]);
    }
    public function editorAddNewAndView(){
        $Exam = Exam::select('*')->get();
        $Users = User::select('id','name','role')->get();
        $Groups = Groups::select('*')->get();
        $now = Carbon::now()->format('Y-m-d\TH:i');
        return view('editor::add',['Exam' => $Exam, 'Users' => $Users,'Groups' => $Groups, 'now' => $now]);
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
        $settings = Exam::select('time','random','xOFy','progressive','rules_page')->where('id',$id)->get();
        $UserBelongs = ExamUser::where('exam_id','=',$id)->get();
        $Users = User::select('id','name','role')->get();
        $Groups = Groups::select('*')->get();
        foreach ($Users as $user){
            $user->setAttribute('status','noBelong');
            $UserBelongs->each(function ($item) use ($user){
                if($user->id == $item->user_id){
                    $user->setAttribute('status', 'belong');
                }
            });
        }

        foreach ($Groups as $group){
            $group->setAttribute('groupStatus','noBelong');
            $UserBelongs->each(function ($item) use ($group){
                if($group->id == $item->group_id){
                    $group->setAttribute('groupStatus', 'belong');
                }
            });
        }

        return view('editor::exam.exam', ['exam' => $exam, 'edit_id' => null,'Users' => $Users,'Groups' => $Groups, 'Settings' => $settings]);
    }

    public function editorEditExam(Request $request, $id){
        $answer = Question::getAnswerContent();
        $settings = Exam::select('time','random','xOFy','progressive','rules_page')->where('id',$id)->get();
        $answerCorrect = Question::select('multi_answer_corrects.answer')->join('answers','answers.question_id','=','questions.id')->join('multi_answer_corrects','multi_answer_corrects.answer','=','answers.answer_id')->get();
        $exam = Exam::where('id', $id)->first();
        $UserBelongs = ExamUser::select('*')->where('exam_id','=',$id)->get();
        $Users = User::select('id','name','role')->get();
        $Groups = Groups::select('*')->get();

        foreach ($Users as $user){
            $user->setAttribute('status','noBelong');
            $UserBelongs->each(function ($item) use ($user){
                if($user->id == $item->user_id){
                    $user->setAttribute('status', 'belong');
                }

            });
        }

        foreach ($Groups as $group){
            $group->setAttribute('groupStatus','noBelong');
            $UserBelongs->each(function ($item) use ($group){
                if($group->id == $item->group_id){
                    $group->setAttribute('groupStatus', 'belong');
                }
            });
        }

        return view('editor::exam.exam', ['exam' => $exam,'answer' =>$answer, 'edit_id' => $request->edit_id,'Users' => $Users,'Groups' => $Groups, 'AnswerCorrect' => $answerCorrect, 'Settings' => $settings]);
    }
}
