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
                    @endforeach
                @endif
            @if($answer->question_type == 2)
                <div class="well">{{$answer->answer_text}}</div>
                @endif
</div>
        <hr />
        @endforeach
</div>
@endsection