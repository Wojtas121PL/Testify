<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamUser;
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
        $Users = User::leftJoin('exam_users','users.id','=','exam_users.user_id')->select('users.id','name','exam_id')->get();
        return view('admin::exam.exam', ['exam' => $exam, 'edit_id' => null,'Users' => $Users, 'UsersBelongs' => $UserBelongs]);
    }
    public function editExam(Request $request, $id){
        $answer = Question::getAnswerContent();
        $exam = Exam::where('id', $id)->first();
        $UserBelongs = ExamUser::select('*')->where('exam_id','=',$id)->get();
        $Users = User::select('users.id','name')->get();
        return view('admin::exam.exam', ['exam' => $exam,'answer' =>$answer, 'edit_id' => $request->edit_id,'Users' => $Users, 'UsersBelongs' => $UserBelongs]);
    }

}
