<?php

namespace Modules\Editor\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Modules\Exam\Entities;
use Carbon\Carbon;

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
        $exams = Entities\Exam::all();
        return view('editor::exam.list', ['exams' => $exams]);
    }
    public function editorEdit($id){
        $exam = Entities\Exam::where('id', $id)->first();
        return view('editor::exam.exam', ['exam' => $exam, 'edit_id' => null]);
    }

    public function editorEditExam(Request $request, $id){
        $exam = Entities\Exam::where('id', $id)->first();
        return view('editor::exam.exam', ['exam' => $exam, 'edit_id' => $request->edit_id]);
    }
}
