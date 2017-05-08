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
        $Test[]  = TestsName::find('1')->Name;
        $Test[]  = TestsName::find('2')->Name;
        return view('list', ['Tests' => $Test]);
    }
}
