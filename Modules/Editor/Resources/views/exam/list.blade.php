@extends('editor::layouts.master')


@section('content')
    @parent
    @include('editor::includes.displayErrors')
    <p>Wybierz jeden z dostępnych testów</p>
        @foreach($exams as $exam)

                <form action="{{route('exam.destroy', $exam->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">

                    <div class="input-group" >
                        <a href="{{'exam/'.$exam->id}}" class="form-control" style="height:auto;">{{$exam->name}}</a>
                        <span class="input-group-btn" >
                            <button class="btn btn-danger" type="submit">Usuń</button>
                        </span>
                    </div>
                </form>

        @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('editor::includes.create')
        </div>
    </div>
@endsection