@extends('admin::layouts.master')
@section('content')
    @parent
<div>
    <a href="{{route('results.admin.index')}}"><button class="btn btn-default">Back</button></a>
    <div>
        Legenda:<br>
        Niebieski - Odpowiedź nie poprawna nie zaznaczona przez użytkownika<br>
        Żółty - Odpowiedź poprawna niezaznaczona przez użytkownika<br>
        Zielony - Odpowiedź poprawna zaznaczona przez użytkownika<br>
        Czerwony - Odpowiedź nie poprawna zaznaczona przez użytkownika<br>
    </div>
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
                @foreach($typeAnswer as $value)
                    @if($value->correct == "true" && $value->correctUser == "checked")
                        <div class="input-group">
                            <span class="input-group-addon">&#x2611;</span>
                            <span class="form-control" style="background-color:green;">{{$value->answer}}</span>
                        </div>
                    @elseif($value->correctUser == "unchecked" && $value->correct != "true")
                        <div class="input-group">
                            <span class="input-group-addon">&#x2610;</span>
                            <span class="form-control" style="background-color:blue;">{{$value->answer}}</span>
                        </div>
                    @elseif($value->correctUser == "unchecked" && $value->correct == "true")
                        <div class="input-group">
                            <span class="input-group-addon">&#x2612;</span>
                            <span class="form-control" style="background-color:yellow;">{{$value->answer}}</span>
                        </div>
                    @else
                        <div class="input-group">
                            <span class="input-group-addon">&#x2610;</span>
                            <span class="form-control" style="background-color: red;">{{$value->answer}}</span>
                        </div>
                        @endif
                @endforeach
                @endif

</div>
        <hr />
        @endforeach
</div>
@endsection