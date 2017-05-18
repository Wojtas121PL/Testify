<?php

namespace Testify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->role){
            case 1:
                return redirect('admin');
                break;
            case 2:
                return redirect('editor');
                break;
            case 3:
                return redirect('user');
                break;
        }
        return view('home');
    }
}
