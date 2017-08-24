@extends('admin::layouts.master')
@section('content')
    @parent
<div>
    <a href="{{route('results.admin.index')}}"><button class="btn btn-default">Back</button></a>
    <div>
        Legenda:<br>
        Brak koloru - Odpowiedź niepoprawna niezaznaczona przez użytkownika<br>
        Żółty - Odpowiedź poprawna niezaznaczona przez użytkownika<br>
        Zielony - Odpowiedź poprawna zaznaczona przez użytkownika<br>
        Czerwony - Odpowiedź niepoprawna zaznaczona przez użytkownika<br>
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
                        <label class="input-group">
                            <span class="input-group-addon">&#x2611;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </label>
                    @elseif($d == $item->answer_int)
                        <label class="input-group">
                            <span class="input-group-addon">&#x2612;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </label>
                    @elseif($d == $answer->answer_correct)
                        <label class="input-group">
                            <span class="input-group-addon">&#x2611;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </label>
                        @else
                        <label class="input-group">
                            <span class="input-group-addon">&#x2610;</span>
                            <span class="form-control">{{$item->answer}}</span>
                        </label>
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
                        <label class="input-group">
                            <span class="input-group-addon" style="background-color:#93ff93;">&#x2611;</span>
                            <span class="form-control">{{$value->answer}}</span>
                        </label>
                    @elseif($value->correctUser == "unchecked" && $value->correct != "true")
                        <label class="input-group">
                            <span class="input-group-addon">&#x2610;</span>
                            <span class="form-control">{{$value->answer}}</span>
                        </label>
                    @elseif($value->correctUser == "unchecked" && $value->correct == "true")
                        <label class="input-group">
                            <span class="input-group-addon" style="background-color:#ffff93;">&#x2612;</span>
                            <span class="form-control">{{$value->answer}}</span>
                        </label>
                    @else
                        <label class="input-group">
                            <span class="input-group-addon"  style="background-color: #ff9393;">&#x2610;</span>
                            <span class="form-control">{{$value->answer}}</span>
                        </label>
                        @endif
                @endforeach
                @endif

</div>
        <hr />
        @endforeach
</div>
@endsection