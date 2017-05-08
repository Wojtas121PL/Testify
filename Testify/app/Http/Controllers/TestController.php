<?php

namespace Testify\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Testify\tests;
class TestController extends Controller
{
    public function __invoke()
    {
        $questions  = tests::where('TestId', '=', '1')->get();
        return view('test', ['questions' => $questions]);
    }

    public function create($id = null)
    {
        $questions  = tests::where('TestId', '=', $id)->get();
        return view('test', ['questions' => $questions]);
    }
}
