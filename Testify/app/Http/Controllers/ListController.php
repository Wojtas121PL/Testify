<?php

namespace Testify\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Testify\tests;
use Testify\TestsName;

class ListController extends Controller
{
    public function __invoke()
    {
        $tests = TestsName::all();
        return view('list', ['Tests' => $tests]);
    }
}
