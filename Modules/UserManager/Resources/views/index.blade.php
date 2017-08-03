@extends('usermanager::layouts.master')

@section('content')
    <div>
        <table class="table table-bordered">
            <tr><td>Lp.</td><td>Nazwa</td><td>Email</td><td>Rola</td><td>Utworzony</td><td>Zaaktulizowany</td></tr>
            @php
                $arrayRole=array("Admin" => 1,"Editor"=>2,"User"=>3);
            @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if($user->role == 0)
                        <td>Konto nieaktywne</td>
                    @endif
                    @if($user->role == 1)
                        <td>Administrator</td>
                    @endif
                    @if($user->role == 2)
                        <td>Edytor</td>
                    @endif
                    @if($user->role == 3)
                        <td>Użytkownik</td>
                    @endif
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><a href="{{url('/usermanager/edit/'.$user->id)}}"><button class="btn btn-info">Zmień</button></a></td>
                </tr>
            @endforeach
        </table>
        <a href="{{url('usermanager/addUser')}}"><button class="btn btn-success">Dodaj</button></a>
    </div>
@stop
