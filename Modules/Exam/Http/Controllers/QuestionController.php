<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Question;
use Modules\Exam\Entities\Exam;
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
        $question_number = Question::where('exam_id', $request->exam_id)->count() + 1;


        $question = new Question;

        $question->exam_id = $request->exam_id;
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

        return redirect(url('admin/exam/'. $id));
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
