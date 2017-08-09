@extends('groupmanager::layouts.master')

@section('content')
    <table class="table table-bordered">
        <tr><td>Lp.</td><td>Nazwa grupy</td><td>Użytkownicy</td><td> </td><td> </td></tr>
        @php($i=1)
        @foreach($Groups as $group)
            <tr>
            <td>{{$i}}</td>
            <td>{{$group->group_name}}</td>
                <td>
                    @foreach($UsersGroup as $userGroup)
                        @if($userGroup->group_name == $group->group_name)
                            <span>{{$userGroup->name}}</span>
                            @endif
                    @endforeach
                </td>
                <td>
                    <button class="btn btn-info">Edytuj</button>
                </td>
                <td>
                    <button class="btn btn-danger">Skasuj</button>
                </td>
            </tr>
            @php($i++)
        @endforeach
    </table>

    <a href="{{route('add.groupAndUsers')}}"><button type="button" class="btn btn-success">Dodaj grupę</button></a>
@stop
