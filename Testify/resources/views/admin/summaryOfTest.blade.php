@extends('layouts.app')
@section('content')
    @parent
<div>
    @foreach($Answers as $answer)
        <div>
            <span>Question Number {{$answer->question_number}}</span>
            <h1>{{$answer->question_title}}</h1>
            @for($i=1;$i<5;$i++)
                @if($i == $answer->Answer && $i == $answer->answer_correct)
                    <span class="bg-info">&#x2611;{{json_decode($answer->answer_list,true)[$i]}}</span><br />
                @elseif($i == $answer->Answer)
                    <span class="bg-info">{{json_decode($answer->answer_list,true)[$i]}}</span><br />
                @elseif($i == $answer->answer_correct)
                    <span class="bg-success">&#x2611;{{json_decode($answer->answer_list,true)[$i]}}</span><br />
                @else
                    <span>{{json_decode($answer->answer_list,true)[$i]}}</span><br />
                @endif
            @endfor
</div>
        <hr />
        @endforeach
</div>
@endsection