@extends('user.layouts.app')


@section('content')
    @parent
    <form action="{{url('user/exam/'.$id.'/')}}" method="post">
        {{csrf_field()}}
        @foreach($examContent as $question)
            @php
            $answers = json_decode($question->answer_list, true);
            @endphp
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Question number {{$question->id}}:</p>
                    <p><strong>{{$question->question_title}}</strong></p>

                    @for($i = 1; $i <= count($answers); $i++)
                        <input type="radio" name="answer[{{$question->id}}][number]" value="{{$i}}">{{$answers[$i]}}<br />
                    @endfor
                </div>
            </div>
        @endforeach
        <input type="hidden" name="test" value="{{$id}}">
        <input type="submit" value="End Test">
    </form>
@endsection