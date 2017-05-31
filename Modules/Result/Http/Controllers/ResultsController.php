<?php

namespace Modules\Result\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Exam\Entities\Answer;
use Modules\Exam\Entities\Result;
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
        $typeAnswer = Results::getAnswersToResult($testId);
        return view('admin::summaryOfTest',['Answers' => $answer,'typeAnswer' => $typeAnswer]);
    }

    public function saveToDatabase(SaveResult $request){
        foreach ($request->answer as $id => $item) {
                $result = new Results();
                $result->exam_id = $request->exam_id;
                $result->user_id = Auth::id();
                $result->question_id = $id;
                if ($item['typeId'] == 1){
                    $result->answer_int = $item['number'];
                }
                if ($item['typeId'] == 2){
                    $result->answer_text = $item['number'];
                }
            $result->save();
        }
        return redirect('/user/list')->with('done','yes');
    }

    public function saveToDatabaseProgressive(SaveResult $request){
        foreach ($request->answer as $id => $item) {
            $result = new Results();
            $result->exam_id = $request->exam_id;
            $result->user_id = Auth::id();
            $result->question_id = $id;
            if ($item['typeId'] == 1){
                $result->answer_int = $item['number'];
            }
            if ($item['typeId'] == 2){
                $result->answer_text = $item['number'];
            }
            $result->save();
        }
        return redirect('/user/exam/'.$result->exam_id."/". ($result->question_id + 1));
    }
}
