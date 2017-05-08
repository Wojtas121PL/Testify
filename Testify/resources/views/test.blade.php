@extends('layouts.app')


@section('content')
    @parent
    <form name="#">
        @foreach($questions as $question)
            <div class="panel panel-default">
                <div class="panel-body">
            <p>Question number {{$question->QuestionId}}:</p>
            <p><strong>{{$question->Question}}</strong></p>
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->A}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->B}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->C}}<br />
            <input type="radio" name="{{$question->QuestionId}}">{{json_decode($question->Answers)->D}}<br />

                </div></div>
        @endforeach
        <input type="submit" value="Zakończ Test">
    </form>
@endsection