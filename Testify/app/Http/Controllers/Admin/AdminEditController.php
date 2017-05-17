<?php

namespace Testify\Http\Controllers\Admin;

use Testify\Http\Controllers\Controller;
use Testify\Http\Requests\Admin;
use Testify\Exam;
use Testify\Question;


class AdminEditController extends Controller
{

    public function editQuestion(Admin\EditQuestion $request){
        $examId = $request->exam_id;

        if($request->action == 'delete'){
            Exam::where("id", $examId)
                ->first()
                ->questions
                ->where('id', $request->question_id)
                ->first()
                ->delete();
        }

        if($request->action == 'edit') {
            $exam = Exam::find($examId);

            return view('admin.edit.exam', ['exam' => $exam, 'question_id' => $request->question_id]);
        }


        return redirect('admin/edit/'.$examId);
    }



    public function editExam(Admin\EditExam $request){

        if($request->action == 'delete'){
            $exam_id = $request->exam_id;
            Exam::where("id", $exam_id)
                ->first()
                ->delete();
            return redirect('admin/edit/');

        }


        if($request->action == 'save'){
            if($request->new_name){
                $exam = Exam::where('id', $request->exam_id)->first();

                $exam->name = $request->new_name;

                $exam->save();

            }
            return redirect('admin/edit/'.$request->exam_id);

        }
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

    public function saveQuestion(Admin\SaveQuestion $request, $id){


        $question = Question::where('id', $request->question_id)->first();

        $question->exam_id = $id;
        $question->question_number = $request->question_number;
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
