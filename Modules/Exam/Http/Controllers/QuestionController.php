<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Exam\Entities\Question;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\Answer;
use Modules\Result\Entities\MultiAnswerCorrect;
use Modules\Exam\Http\Requests;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('exam::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('exam::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Requests\StoreQuestion $request)
    {
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;

        $question = new Question;
        $question->exam_id = $request->exam_id;
        $question->question_number = $question_number;
        $question->question_title = $request->question_title;
        $question->question_type = $request->question_type;
        $question->answer_correct = $request->answer_correct;
        $question->save();
        $answerCounter = 1;
        foreach ($request->answer as $item){
            $answer = new Answer;
            $question_id = Question::select('id')->where('exam_id','=',$request->exam_id)->where('question_number','=',$question_number)->get();
            $answer->question_id = $question_id['0']->id;
            $answer->answer = $item['answer'];
            $answer->answer_id = $answerCounter;
            $answer->save();
            $answerCounter++;

        }
        return back();
    }

    public function storeOpen(Requests\StoreQuestionOpen $request)
    {
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;

        $question = new Question;

        $question->exam_id = $request->exam_id;
        $question->question_number = $question_number;
        $question->question_title = $request->question_title;
        $question->question_type = $request->question_type;
        $question->answer_correct = null;
        $question->save();

        return back();
    }

    public function storeMultiCheck(Requests\StoreMultiCheck $request){
        $question_number = Question::where('exam_id','=',$request->exam_id)->count() + 1;


        $question = new Question;
        $question->exam_id = $request->exam_id;
        $question->question_number = $question_number;
        $question->question_title = $request->question_title;
        $question->question_type = $request->question_type;
        $question->answer_correct_multi = 1;

        $question->save();

        $answerCounter = 1;

        foreach ($request->answer as $item){
            $answer = new Answer;
            $answer->question_id = $question->id;
            $answer->answer = $item['answer'];
            $answer->answer_id = $answerCounter;

            $answer->save();

            $answerCounter++;
        }
        foreach ($request->answer_correct as $i => $item){
            $answerCorrect = new MultiAnswerCorrect();
            $answerCorrect->exam_id=$request->exam_id;
            $answerCorrect->question_id = $question->id;
            $answerCorrect->answer = $item['check'];

            $answerCorrect->save();
        }


        return back();
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('exam::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('exam::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Requests\UpdateQuestion $request
     * @return Response
     */
    public function update(Requests\UpdateQuestion $request, $id)
    {

        $question = Question::where('id', '=',$request->question_id)->first();
        $question->exam_id = $id;
        $question->question_number = $request->question_number;
        $question->question_title = $request->question_title;

        if ($request->question_type == 1){
            $question->answer_correct = $request->answer_correct;
        }
        if ($request->question_type == 3){
                foreach ($request->answer_correct as $i => $item){
                    if ($item['set'] == 1 && !isset($item['check'])) {
                        MultiAnswerCorrect::where('exam_id', $id)->where('question_id', $request->question_number)->where('answer',$i)->first()->delete();
                    }

                    if (isset($item['check'])) {
                        if ($item['set'] == 0 && $item['check'] == 'on') {
                            $answerCorrect = new MultiAnswerCorrect();
                            $answerCorrect->answer = $i;
                            $answerCorrect->exam_id = $id;
                            $answerCorrect->question_id = $request->question_number;
                            $answerCorrect->save();
                        }
                    }
                }
        }
        if ($request->answers != null) {
            foreach ($request->answers as $i => $answer) {
                $change = Answer::where('question_id', $request->question_id)->where('answer_id', $i)->first();
                $change->answer = $answer['answer'];
                $change->save();
            }
        }
        switch (Auth::user()->role)
        {
            case 1:
                return redirect('admin/exam/edit/'.$id);
                    break;
            case 2:
                return redirect('editor/exam/edit/'.$id);
                    break;
        }
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Requests\DestroyQuestion $request, $id)
    {
        Exam::where("id", $id)
            ->first()
            ->questions
            ->where('id', $request->question_id)
            ->first()
            ->delete();

        return back();
    }
}
