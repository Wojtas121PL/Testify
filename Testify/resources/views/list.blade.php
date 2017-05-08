@extends('layouts.app')


@section('content')
    @parent
    <p> Choose one of avaible test</p>
    <ul class="nav nav-pills nav-stacked">
        <ul class="nav nav-pills nav-stacked">
            @foreach($Tests as $i => $test)
                <li role="presentation"><a href="/test/{{++$i}}">{{$test}}</a></li>
            @endforeach
        </ul>
    </ul>
@endsection