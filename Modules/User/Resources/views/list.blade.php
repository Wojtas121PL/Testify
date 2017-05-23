@extends('user::layouts.master')


@section('content')
    @parent
    <p> Choose one of avaible test</p>
    <ul class="nav nav-pills nav-stacked">
        @foreach($exams as $exam)
            <li role="presentation"><a href="{{'exam/'.$exam->id}}">{{$exam->name}}</a></li>
        @endforeach
    </ul>
@endsection