<?php

namespace Testify\Http\Controllers\Admin;

use Testify\Http\Controllers\Controller;
use Testify\Exam;

class AdminExamController extends Controller
{
    public function __invoke(){
        $exams = Exam::all();
        return view('admin.list', ['exams' => $exams]);
    }

    public function performExam($id){
        $examContent = Exam::find($id)->questions;
        return view('admin.exam', ['examContent' => $examContent]);
    }

    public function editList(){
        $exams = Exam::all();
        return view('admin.edit.list', ['exams' => $exams]);
    }

    public function editExam($id){
        $examContent = Exam::find($id)->questions;
        return view('admin.edit.exam', ['examContent' => $examContent, 'id' => $id]);
    }

}
