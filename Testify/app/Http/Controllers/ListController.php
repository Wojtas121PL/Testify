<?php

namespace Testify\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Testify\tests;
class ListController extends Controller
{
    public function __invoke()
    {
        $Test  = tests::select('TestId')->groupBy('TestId')->get();
        return view('list', ['Tests' => $Test]);
    }
}
