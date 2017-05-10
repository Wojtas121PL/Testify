@extends('layouts.app')


@section('content')
    @parent
    <p> Choose one of avaible test</p>
    <ul class="nav nav-pills nav-stacked">
        @foreach($exams as $i => $exam)
            <li role="presentation"><a href="/test/{{++$i}}">{{$exam->name}}</a></li>
        @endforeach
    </ul>
@endsection