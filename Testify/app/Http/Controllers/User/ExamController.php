<?php

namespace Testify\Http\Controllers\User;

use Illuminate\Http\Request;
use Testify\Http\Controllers\Controller;
use Testify\Exam;

class ExamController extends Controller
{
    public function __invoke(){
        $exams = Exam::all();
        return view('user.list', ['exams' => $exams]);
    }

    public function performExam($id){
        $examContent = Exam::find($id)->questions;
        return view('user.exam', ['examContent' => $examContent]);
    }
}
