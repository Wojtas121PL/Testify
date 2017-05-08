@extends('layouts.master')

@section('menu')
    @parent
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="/user">Home</a></li>
        <li role="presentation"><a href="/tests">Tests</a></li>
        <hr />
                <ul class="nav nav-pills nav-stacked">
                    @foreach($Tests as $test)
                    <li role="presentation"><a href="/chossed{{$test->TestId}}">{{$test->TestId}}</a></li>
            @endforeach
                </ul>
    </ul>
@endsection

@section('content')
    @parent
    <p> Choose one of avaible test</p>
@endsection