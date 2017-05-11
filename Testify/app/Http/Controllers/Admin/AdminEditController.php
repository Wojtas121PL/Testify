<?php

namespace Testify\Http\Controllers\Admin;

use Testify\Http\Controllers\Controller;
use Testify\Http\Requests\Admin;
use Testify\Exam;

class AdminEditController extends Controller
{

    public function deleteQuestion(Admin\DeleteQuestion $request){
        $exam_id = $request->exam_id;
        Exam::where("id", $exam_id)
            ->first()
            ->questions
            ->where("question_number", '=', $request->question_number)
            ->first()
            ->delete();
        return redirect('admin/edit/'.$exam_id);
    }

    public function deleteExam(Admin\DeleteExam $request){
        $exam_id = $request->exam_id;
        Exam::where("id", $exam_id)
            ->first()
            ->delete();
        return redirect('admin/edit');
    }

    public function addExam(Admin\AddExam $request){
        $exam = new Exam;

        $exam->name = $request->exam_name;

        $exam->save();

        return redirect('admin/edit');
    }
}
