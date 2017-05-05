<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\tests;
class TestsController extends Controller
{
    public function __invoke()
    {
        $Test  = tests::select('TestId')->groupBy('TestId')->get();
        return view('tests', ['Tests' => $Test]);
    }
}
