@extends('layouts.app')


@section('content')
    @parent
    <form name="#">
        @foreach($examContent as $question)
            @php
            $answers = json_decode($question->answer_list, true);
            @endphp
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Question number {{$question->question_number}}:</p>
                    <p><strong>{{$question->question_title}}</strong></p>

                    @for($i = 1; $i <= count($answers); $i++)
                        <input type="radio" name="{{$question->question_number}}">{{$answers[$i]}}<br />
                    @endfor
                </div>
            </div>
        @endforeach

        <input type="submit" value="Zakończ Test">
    </form>
@endsection