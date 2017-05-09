@extends('layouts.app')


@section('content')
    @parent
    <form name="#">
        @foreach($questions as $question)
            @php
            $answers = json_decode($question->Answers, true);
            @endphp
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Question number {{$question->QuestionId}}:</p>
                    <p><strong>{{$question->Question}}</strong></p>

                    @for($i = 1; $i <= count($answers); $i++)
                        <input type="radio" name="{{$question->QuestionId}}">{{$answers[$i]}}<br />
                    @endfor
                </div>
            </div>
        @endforeach

        <input type="submit" value="Zakończ Test">
    </form>
@endsection