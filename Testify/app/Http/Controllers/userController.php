<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\tests;
class userController extends Controller
{
    public function __invoke()
    {
        $questions = tests::where('TestId', '=', '1')->get();


        return view('user', ['questions' => $questions]);
    }
}
