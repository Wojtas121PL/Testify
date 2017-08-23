<?php

namespace Modules\Exam\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Exam;
use Modules\Exam\Entities\ExamUser;
use Modules\Exam\Http\Requests\SaveSetting;
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
        $UserBelongs = ExamUser::select('*')->where('exam_id',$request->testName)->get();
        $counterBack = 0;
        if ($request->user != null) {
            foreach ($request->user as $i => $item) {
                if ($item['set'] == 1 && !isset($item['check'])) {
                    ExamUser::where('user_id', $i)->where('exam_id', $request->testName)->first()->delete();
                }

                if (isset($item['check'])) {
                    if ($item['set'] == 0 && $item['check'] == 'on') {
                        $counter = 0;
                        foreach ($UserBelongs as $user) {
                            $counter = 0;
                            if ($user->user_id == $i) {
                                $counter = 1;
                            }
                        }
                        if ($counter == 0) {
                            $belong = new ExamUser();
                            $belong->user_id = $i;
                            $belong->exam_id = $request->testName;
                            $belong->save();
                            $counterBack++;
                        }
                    }
                }
            }
        }


        if ($request->group != null) {
            foreach ($request->group as $i => $item) {
                if ($item['set'] == 1 && !isset($item['check'])) {
                    ExamUser::where('exam_id', $request->testName)->where('group_id', $i)->first()->delete();
                }

                if (isset($item['check'])) {
                    if ($item['set'] == 0 && $item['check'] == 'on') {
                        $counter = 0;
                        foreach ($UserBelongs as $user) {
                            $counter = 0;
                            if ($user->group_id == $i) {
                                $counter = 1;
                            }
                        }
                        if ($counter == 0) {
                            $belong = new ExamUser();
                            $belong->exam_id = $request->testName;
                            $belong->group_id = $i;
                            $belong->save();
                            $counterBack++;
                        }
                    }
                }
            }
        }
        return back()->with('add',$counterBack);
    }
    public function saveSettings(SaveSetting $request){
        $settingsFromDatabase = Exam::select('time','xOFy')->where('id',$request->exam_id)->get();
        $settingsToDatabase = Exam::where('id',$request->exam_id)->first();
        //Setting for random display question
        if ($request->set_random == 1 && !isset($request->random)){
            $settingsToDatabase->random = null;
        }
        if (isset($request->random)){
            $settingsToDatabase->random = 1;
        }
        //Setting for progressive display question
        if ($request->set_progressive == 1 && !isset($request->progressive)){
            $settingsToDatabase->progressive = 0;
        }
        if (isset($request->progressive)){
            $settingsToDatabase->progressive = 1;
        }
        //Setting for show rules before exam
        if ($request->set_rules == 1 && !isset($request->rules_page)){
            $settingsToDatabase->rules_page = 0;
            $settingsToDatabase->rules_page_text = null;
        }
        if (isset($request->rules_page)){
            $settingsToDatabase->rules_page = 1;
            $settingsToDatabase->rules_page_text = $request->rules;
        }
        //Settings for exam time and amount question in exam
        if ($settingsFromDatabase[0]->time != $request->time){
            $settingsToDatabase->time = $request->time;
        }
        if ($settingsFromDatabase[0]->xOFy != $request->xOFy){
            $settingsToDatabase->xOFy = $request->xOFy;
        }
        $settingsToDatabase->save();
        return back();
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
