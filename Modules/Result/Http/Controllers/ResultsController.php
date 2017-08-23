<?php

namespace Modules\Result\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Result\Entities\MultiAnswer;
use Modules\Result\Entities\MultiAnswerCorrect;
use Testify\User;
use \Modules\Admin\Http\Requests\SelectUser;
use \Modules\Result\Http\Requests\SaveResult;
use \Modules\Admin\Entities\Results;
use Illuminate\Support\Facades\Auth;


class ResultsController extends Controller
{
    public function getUserList(){
        $user=User::select('id','name','role')->orderBy('id','ASC')->get();
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
        $answerUser = MultiAnswer::select('*')->where('user_id',$userId)->where('exam_id',$testId)->get();
        $answerCorrect = MultiAnswerCorrect::select('*')->where('exam_id',$testId)->get();
        foreach ($typeAnswer as $value) {
            $value->setAttribute('correctUser','unchecked');
            if ($value->answer_multi_check == 1) {
                $answerUser->each(function ($item) use ($value) {
                    if ($value->question_id == $item->question_id) {
                        if ($item->answer == $value->answer_id) {
                            $value->setAttribute('correctUser', 'checked');
                        }
                    }
                });
                $answerCorrect->each(function ($item) use ($value) {
                    if ($value->question_id == $item->question_id) {
                        if ($item->answer == $value->answer_id) {
                                $value->setAttribute('correct', 'true');
                            }
                        }
                });
            }
        }
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
                if ($item['typeId'] == 3) {
                    foreach ($item as $key => $value){
                        if (is_array($value)==true) {
                            $answer = new MultiAnswer();
                            $answer->user_id = Auth::id();
                            $answer->answer = $key;
                            $answer->exam_id = $request->exam_id;
                            $answer->question_id = $id;
                            $result->answer_multi_check = 1;
                            $answer->save();
                        }
                    }
                }
            $result->save();
        }
        return redirect('/user/list')->with('done','yes');
    }

    public function saveToDatabaseProgressive(SaveResult $request){
        dd("Stop");
        dd($request->answer_multi);
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
