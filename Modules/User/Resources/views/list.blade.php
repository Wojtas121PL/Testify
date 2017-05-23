@extends('user::layouts.master')


@section('content')
    @parent
    @if(session('examDone') == 'yes')
        <div class="alert alert-danger">
            You have been finished this test
        </div>
    @endif
    @if(session('examExpire') == 'yes')
        <div class="alert alert-danger">
            This exam is expired
        </div>
    @endif
    <p> Choose one of avaible test</p>
    <ul class="nav nav-pills nav-stacked">
        @foreach($exams as $exam)
            <li role="presentation"><a href="{{'exam/'.$exam->id}}">{{$exam->name}}</a></li>
        @endforeach
    </ul>
@endsection