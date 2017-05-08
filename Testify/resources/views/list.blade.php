@extends('layouts.app')

@section('menu')
    @parent
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation"><a href="/list">Tests</a></li>
        <hr />
                <ul class="nav nav-pills nav-stacked">
                    @foreach($Tests as $i=>$test)
                    <li role="presentation"><a href="/test/{{++$i}}">{{$test->TestId}}</a></li>
            @endforeach
                </ul>
    </ul>
@endsection

@section('content')
    @parent
    <p> Choose one of avaible test</p>
@endsection