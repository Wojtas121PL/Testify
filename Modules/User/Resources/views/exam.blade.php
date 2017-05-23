@extends('user::layouts.master')

@section('controls')
    @parent
    <div class="panel panel-default" data-spy="affix" data-offset-top="250">
        <div class="panel-heading">
            Controls
        </div>

        <div class="panel-body">

            <h3 style="margin-top:0;" class="text-center " id="timer"></h3>

            <form action="#">
                <div class="btn-group-vertical" style="width:100%">
                        <button type="submit" class="btn btn-warning" id="submit">Submit exam</button>
                        <a class="btn btn-danger" href="/user/exam">Exit exam</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    @parent

        @foreach($examContent->questions as $question)
            @php
                $answers = json_decode($question->answer_list, true);
            @endphp
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{$question->question_title}}</h4>
                </div>
                <div class="panel-body">

                    @for($i = 1; $i <= count($answers); $i++)
                        <div class="input-group">
                            <span class="input-group-addon"><input type="radio" name="{{$question->id}}"></span>
                            <div class="form-control">{{$answers[$i]}}</div>
                        </div>
                    @endfor

                </div>
            </div>

        @endforeach
@endsection