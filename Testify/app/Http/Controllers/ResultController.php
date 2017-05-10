<?php

namespace Testify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Testify\Http\Requests\SelectUser;
use Testify\Results;


class ResultController extends Controller
{

    public function getUserList(){
        $user=DB::table('users')->select('id')->get();
        return $user;
    }
    public function getUserListAndViews(){
        return view('Result',['Users' => $this->getUserList()]);
    }
    public function getAnswersByUserId(SelectUser $selectUser)
    {
        $Answer = Results::getAnswers($selectUser->SelectedUser);
        return view('Result',['Answers' => $Answer,'Users' => $this->getUserList()]);
    }
}
