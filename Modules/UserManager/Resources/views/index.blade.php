@extends('usermanager::layouts.master')

@section('content')
    @if(null != session('delete'))
        @if(session('delete') == 'deactive')
            <div class="alert alert-success">Usunięto dezaktywowane konto</div>
        @endif
        @if(session('delete') == 'root')
            <div class="alert alert-danger">Próba usunięcia konta głównego administratora. Akcja zabroniona</div>
        @endif
        @if(session('delete') == 'admin')
            <div class="alert alert-success">Usunięto konto admina</div>
        @endif
        @if(session('delete') == 'editor')
            <div class="alert alert-success">Usunięto konto edytora</div>
        @endif
        @if(session('delete') == 'user')
            <div class="alert alert-success">Usunięto konto użytkownika</div>
        @endif
    @endif
    <div>
        <table class="table table-bordered">
            <tr><td>Lp.</td><td>Nazwa</td><td>Email</td><td>Rola</td><td>Utworzony</td><td>Zaaktulizowany</td></tr>
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
