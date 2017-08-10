@extends('admin::layouts.master')

@section('content')
    @parent
    @include('admin::includes.displayErrors')
    @if(null != session('add'))
        @if(session('add') != 0)
            <div class="alert alert-success">Użytkownicy od teraz mają zezwolenie na rozwiązanie egzaminu</div>
            @elseif(session('add') == 0)
            <div class="alert alert-warning">Brak zmian</div>
        @endif
    @endif
    <form class="panel panel-default">
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
            <form method="post" action="{{route('saveUsers.exam')}}">
            <div class="table-bordered">
                    {{csrf_field()}}
                    <input type="hidden" name="testName" value="{{$exam->id}}">
                    <div>
                        @foreach($Users as $i => $user)
                            @if($user->role == 3)
                                    @if($user->status == "belong")

                                        <input type="checkbox" name="user[{{$user->id}}][check]" checked>{{$user->name}}
                                        <input type="hidden" name="user[{{$user->id}}][set]" value="1">
                                    @else
                                        <input type="checkbox" name="user[{{$user->id}}][check]" >{{$user->name}}
                                    <input type="hidden" name="user[{{$user->id}}][set]" value="0">
                                    @endif
                            @endif
                        @endforeach
                    </div>
            </div>
                <div class="table-bordered">
                    <label>Wybierz grupy które mają prawo wykonać test</label><br />
                    @foreach($Groups as $group)
                        @if($group->groupStatus == "belong")
                            <input type="checkbox" name="group[{{$group->id}}][check]" checked>{{$group->group_name}}
                            <input type="hidden" name="group[{{$group->id}}][set]" value="1">
                        @else
                            <input type="checkbox" name="group[{{$group->id}}][check]" >{{$group->group_name}}
                            <input type="hidden" name="group[{{$group->id}}][set]" value="0">
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="btn-success">Zapisz</button>
    </form>
    </div>
        @endisset
    @foreach($exam->questions as $question)

        @if($question->id == $edit_id)
            @include('admin::exam.edit.panelEdit')
        @else
            @include('admin::exam.edit.panelDisplay')
        @endif

    @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        @include('admin::exam.edit.addNewQuestion')
    </div>
@endsection