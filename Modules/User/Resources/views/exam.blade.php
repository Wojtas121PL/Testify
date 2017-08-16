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
                        <button type="submit" class="btn btn-warning" id="submit">Zakończ egzamin</button>
                        <a class="btn btn-danger" href="/user/exam">Wyjdź z egzaminu</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    @parent
        <form method="post" action="{{url('result/save')}}">
            {{csrf_field()}}
            <input type="hidden" name="exam_id" value="{{$examContent->id}}">
        @foreach($examContent->questions as $question)
            <input type="hidden" name="answer[{{$question->id}}][typeId]" value="{{$question->question_type}}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{$question->question_title}}</h4>
                </div>
                <div class="panel-body">
                    @if($question->question_type == 1)
                    @foreach($question->answers as $i => $answer )

                        <label class="input-group">
                            <span class="input-group-addon"><input type="radio" name="answer[{{$question->id}}][number]" value="{{++$i}}" ></span>
                            <div class="form-control">{{$answer->answer}}</div>
                        </label>
                    @endforeach
                    @endif
                    @if($question->question_type == 2)
                        <label class="input-group">
                            <textarea name="answer[{{$question->id}}][number]" placeholder="Napisz swoją odpowiedź tutaj..."></textarea>
                        </label>
                    @endif
                    @if($question->question_type == 3)
                            @php($counter=1)
                            @foreach($question->answers as $i => $answer )
                                <label class="input-group">
                                    <span class="input-group-addon"><input type="checkbox" name="answer[{{$question->id}}][{{$counter}}][number]" value="{{++$i}}" ></span>
                                    <div class="form-control">{{$answer->answer}}</div>
                                </label>
                                @php($counter++)
                            @endforeach
                    @endif
                </div>
            </div>


        @endforeach

        <button class="btn btn-success" type="submit">Zakończ</button>
        </form>
@endsection