<?php

namespace Testify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Testify\Http\Requests\TestCreator;
use Testify\tests;

class MenagerController extends Controller
{
    public function addQuestion (TestCreator $request) {
        tests::addNewQuestion($request);
        \Redirect('/addQuestion');
    }
    public function formQuestion(){
        return view('addNew');
    }
}
