<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamUser;
use Modules\Exam\Http\Requests\SaveUsers;
use Modules\Exam\Http\Requests\StoreExam;
use Modules\Exam\Http\Requests\UpdateExam;


class ExamController extends Controller
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
     * @param  StoreExam $request
     * @return Response
     */
    public function store(StoreExam $request)
    {
        $exam = new Exam;

        $exam->name = $request->exam_name;

        $exam->save();

        $result = 'Succesfuly added exam '.$request->exam_name;

        return back()->with($result);
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
     * @param  UpdateExam $request
     * @return Response
     */
    public function update(UpdateExam $request, $id)
    {
        $exam = Exam::where('id', $id)->first();

        $exam->name = $request->new_name;

        $exam->save();

        return back();
    }
    public function saveUsers(SaveUsers $request){
        foreach ($request->user as $i => $item){
            $belong = new ExamUser;
            $belong->user_id = $i;
            $belong->exam_id = $request->testName;
            $belong->save();
        }
        return back()->with('add','yes');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        Exam::where("id", $id)
            ->first()
            ->delete();
        return back();
    }
}
