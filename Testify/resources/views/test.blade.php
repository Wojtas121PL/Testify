@extends('layouts.app')


@section('content')
    @parent
    <form name="#">
        @foreach($questions as $question)
            @php
            $answers = json_decode($question->Answers, true);
            dd($question);
            @endphp
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Question number {{$question->QuestionId}}:</p>
                    <p><strong>{{$question->Question}}</strong></p>

                    @foreach($answers as $answer)
                        <input type="radio" name="{{$question->QuestionId}}">{{$answer}}<br />

                    @endforeach
                </div>
            </div>
        @endforeach

        <input type="submit" value="Zakończ Test">
    </form>
@endsection