<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Testify\User;
use \Modules\Admin\Http\Requests\SelectUser;
use \Modules\Admin\Entities\Results;

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
}
