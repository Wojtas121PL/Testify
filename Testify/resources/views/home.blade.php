@extends('layouts.app')

@section('menu')
    @parent
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation"><a href="/list">Tests</a></li>
    </ul>
@endsection

@section('content')
    @parent
    <p>
        Welcome in the biggest platform for testing people. Choose one of avaible test in menu which you find in left-side web-browser. Good Luck
    </p>
@endsection