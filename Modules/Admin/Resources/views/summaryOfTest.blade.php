@extends('admin::layouts.master')
@section('content')
    @parent
<div>
    <a href="{{url('result/admin')}}"><button class="btn btn-default">Back</button></a>
    @foreach($Answers as $answer)
        <div>
            <span>Pytanie numer: {{$answer->question_number}}</span>
            <h1>{{$answer->question_title}}</h1>
                @if($answer->question_type == 1)
                    @php($d=1)
                    @foreach($typeAnswer as $id => $item)
                        @if($item->question_id == $answer->question_id)
                        @if($d == $answer->answer_correct && $d == $item->answer_int)
                        <div class="input-group">
                            <span class="input-group-addon">&#x2611;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </div>
                    @elseif($d == $item->answer_int)
                        <div class="input-group">
                            <span class="input-group-addon">&#x2612;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </div>
                    @elseif($d == $answer->answer_correct)
                        <div class="input-group">
                            <span class="input-group-addon">&#x2611;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </div>
                        @else
                        <div class="input-group">
                            <span class="input-group-addon">&#x2610;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </div>
                            @endif
                        @php($d++)
                            @endif
                    @endforeach
                @endif
            @if($answer->question_type == 2)
                <div class="well">{{$answer->answer_text}}</div>
                @endif
            @if($answer->question_type == 3)
                @php($i=1)
                    @foreach($typeAnswer as $key => $item)
                        <div style="display: none">{{print_r($answerUser = json_decode($answer->answer_text,true))}}</div>
                        <div style="display: none">{{print_r($answerCorrect = json_decode($answer->answer_correct_text,true))}}</div>

                    @endforeach
                @endif

</div>
        <hr />
        @endforeach
</div>
@endsection