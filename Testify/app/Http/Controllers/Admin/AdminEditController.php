<?php

namespace Testify\Http\Controllers\Admin;

use Testify\Http\Controllers\Controller;
use Testify\Http\Requests\Admin;
use Testify\Exam;
use Testify\Question;


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

    public function addQuestion(Admin\AddQuestion $request, $id){

        $question_number = Question::where('exam_id', $id)->count() + 1;


        $question = new Question;

        $question->exam_id = $id;
        $question->question_number = $question_number;
        $question->question_title = $request->question_title;
        $question->answer_list = json_encode([
            1 => $request->answer1,
            2 => $request->answer2,
            3 => $request->answer3,
            4 => $request->answer4
        ]);
        $question->answer_correct = $request->answer_correct;

        $question->save();

        return redirect('admin/edit/'. $id);


    }

}
