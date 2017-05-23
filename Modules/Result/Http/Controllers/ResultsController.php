<?php

namespace Modules\Result\Http\Controllers;

use Illuminate\Routing\Controller;
use Testify\User;
use \Modules\Admin\Http\Requests\SelectUser;
use \Modules\Result\Http\Requests\SaveResult;
use \Modules\Admin\Entities\Results;
use Illuminate\Support\Facades\Auth;


class ResultsController extends Controller
{
    public function getUserList(){
        $user=User::select('id','name')->orderBy('id','ASC')->get();
        return $user;
    }
    public function getUserListAndViews(){
        return view('admin::Result',['Users' => $this->getUserList()]);
    }
    public function getTestsByUserId(SelectUser $selectUser)
    {
        $tests = Results::getTests($selectUser->SelectedUser);
        return view('admin::Result',['Tests' => $tests,'Users' => $this->getUserList(),'Choose' => $selectUser->SelectedUser]);
    }
    public function getAnswerByTestId($userId,$testId){
        $answer = Results::getAnswers($userId,$testId);
        return view('admin::summaryOfTest',['Answers' => $answer]);
    }

    public function saveToDatabase(SaveResult $request){
        $cou=0;
        foreach ($request->except(['_token', 'exam_id']) as $item => $id){
            $cou++;
//                $result = new Results();
//                $result->exam_id = $request->exam_id;
//                $result->user_id = Auth::id();
//                $result->question_id = $item;
//                $result->answer = $id;
//            $result->save();
        }
        dd($cou);
        return back()->with('done','yes');
    }
}
