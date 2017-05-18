<?php

namespace Testify\Http\Controllers\User;

use Illuminate\Http\Request;
use Testify\Http\Controllers\Controller;
use Testify\Exam;
use Testify\Http\Requests\SaveQuestion;
use Testify\Results;
use Testify\test_time;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function __invoke(){
        $exams = Exam::all();
        return view('user.list', ['exams' => $exams]);
    }

    public function performExam($id){
        $examContent = Exam::find($id)->questions;
        $exp = test_time::select('expireTime as time')->where('exam_id','=',$id)->where('user_id','=',Auth::id())->get();
        if (count($exp) != 0) {
            if ((strtotime($exp[0]->time)) < time()) {
                return redirect('/home');
            }
        }
    return view('user.exam', ['examContent' => $examContent, 'id'=>$id]);
    }
    public function saveToDatabase(SaveQuestion $request){
        foreach ($request->answer as $id => $item){
            $result = new Results();
            $result->TestId = $request->test;
            $result->UserId = Auth::id();
            $result->QuestionId = $id;
            $result->Answer =$item['number'];
            $result->save();
        }
        return redirect('/home')->with('test','end');
    }
}
