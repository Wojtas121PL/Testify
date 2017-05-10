@extends('layouts.app')


@section('content')
    @parent
    <form name="#">
        @foreach($examContent as $question)
            @php
            $answers = json_decode($question->answer_list, true);
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>Question number {{$question->question_number}}:</p>
                            <p><strong>{{$question->question_title}}</strong></p>

                            @for($i = 1; $i <= count($answers); $i++)
                                <input type="radio" name="{{$question->question_number}}">{{$answers[$i]}}<br />
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-stacked">
                                <li role="presentation" class="active"><a href="#">Edit</a></li>
                                <li role="presentation"><a href="#">Delete</a></li>
                                <li role="presentation"><a href="#">Messages</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

        <button class="btn bt-lg btn-info btn-group-justified">+</button>
    </form>
@endsection