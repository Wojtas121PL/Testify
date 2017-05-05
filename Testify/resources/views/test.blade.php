@extends('layouts.master')

@section('menu')
    @parent
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="#">Tests</a></li>
    </ul>
@endsection

@section('content')
    @parent
    <form name="#">
        @foreach($questions as $question)
            <p>Question number {{$question->QuestionId}}:</p>
            <p>{{$question->Question}}</p>
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->A}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->B}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->C}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->D}}<br />

            <hr />
        @endforeach
        <input type="submit" value="Zakończ Test">
    </form>
@endsection