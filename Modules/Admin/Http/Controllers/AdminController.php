<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamUser;
use Modules\Exam\Entities\Groups;
use Modules\Exam\Entities\Question;
use Modules\User\Entities\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::index');
    }
    public function show(){
        $exams = Exam::all();
        return view('admin::exam.list', ['exams' => $exams]);
    }

    public function edit($id){
        $exam = Exam::where('id', $id)->first();
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

        return view('admin::exam.exam', ['exam' => $exam, 'edit_id' => null,'Users' => $Users,'Groups' => $Groups]);
    }
    public function editExam(Request $request, $id){
        $answer = Question::getAnswerContent();
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

        return view('admin::exam.exam', ['exam' => $exam,'answer' =>$answer, 'edit_id' => $request->edit_id,'Users' => $Users,'Groups' => $Groups]);
    }

}
