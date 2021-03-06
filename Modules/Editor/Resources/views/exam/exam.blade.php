@extends('editor::layouts.master')

@section('content')
    @parent
    @include('editor::includes.displayErrors')
    @if(null != session('add'))
        @if(session('add') == 'yes')
            <div class="alert alert-success">Użytkownicy od teraz mają zezwolenie na rozwiązanie egzaminu</div>
        @endif
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">Widok egzaminu</div>
        <div class="panel-body">
            <form action="{{route('exam.update', $exam->id)}}" method="post">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="new_name" class="form-control" placeholder="{{$exam->name}}">
                    <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="action" value="save">Zapisz</button>
                    </span>
                </div>
            </form>
        </div>
        @isset($Users)
        <div class="well">Wybierz użytkowników którzy mają prawo wykonać test
            <div class="table-bordered">
                <form action="{{route('saveUsers.exam')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="testName" value="{{$exam->id}}">
                    <div>

                        @foreach($Users as $i => $user)
                            @if($user->role == 3)
                                @if($user->status == "belong")
                                    <input type="checkbox" name="user[{{$user->id}}][check]" checked>{{$user->name}}
                                @else
                                    <input type="checkbox" name="user[{{$user->id}}][check]" >{{$user->name}}
                                @endif
                            @endif
                        @endforeach
                        <button type="submit" class="btn-success">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        @endisset
    @foreach($exam->questions as $question)

        @if($question->id == $edit_id)
            @include('editor::exam.edit.panelEdit')
        @else
            @include('editor::exam.edit.panelDisplay')
        @endif

    @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        @include('editor::exam.edit.addNewQuestion')
    </div>
@endsection