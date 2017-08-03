@extends('user::layouts.master')


@section('content')
    @parent
    @if(session('examDone') == 'yes')
        <div class="alert alert-danger">
            Zakończyłeś ten egzamin
        </div>
    @endif
    @if(session('examExpire') == 'yes')
        <div class="alert alert-danger">
            Czas na wykonanie tego ezaminu dobiegł końca
        </div>
    @endif
    @if(session('done') == 'yes')
        <div class="alert alert-success">
           Skończyłeś egzamin
        </div>
    @endif
    <p>Wybierz jeden z dostępnych testów</p>
    <ul class="nav nav-pills nav-stacked">
        @foreach($exams as $exam)
            @if($exam->status == 'belong')
            @if($exam->status == 'expired')
                <li role="presentation" class="alert-danger"><a href="{{'exam/'.$exam->id}}">{{$exam->name}}</a></li>

            @elseif($exam->status == 'finished')
                <li role="presentation" class="alert-success"><a href="{{'exam/'.$exam->id}}">{{$exam->name}}</a></li>

            @else
                <li role="presentation"><a href="{{'exam/'.$exam->id}}">{{$exam->name}}</a></li>
            @endif
            @endif
        @endforeach
    </ul>
@endsection