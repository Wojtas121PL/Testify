@extends('usermanager::layouts.master')

@section('content')
    @parent
    <div class="panel panel-default">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(null != session('Done'))
            @if(session('Done') == 0)
                <div class="alert alert-warning">Brak zmian</div>
            @elseif(session('Done') == 1)
                <div class="alert alert-success">Email został zmieniony</div>
            @elseif(session('Done') == 2)
                <div class="alert alert-success">Hasło zostało zmienione</div>
            @elseif(session('Done') == 3)
                <div class="alert alert-success">Email i hasło zostało zmienione</div>
            @endif
            @endif
            @if(null != session('root'))
                @if(session('root') == 'try')
                    <div class="alert alert-danger">Próbujesz dezaktywować konto głównego administratora. Akcja zabroniona</div>
                @endif
            @endif
            @if(null != session('disabled'))
                @if(session('disabled') == 'yes')
                    <div class="alert alert-success">Konto zostało zdezaktywowane</div>
                @endif
            @endif
            @if(null != session('was'))
                @if(session('was') == 'yes')
                    <div class="alert alert-warning">Konto było zdeaktywowane</div>
                @endif
            @endif
    <div>
        <div class="form-group">
            <form action="{{url('usermanager/edit/'.$id)}}" method="post">
                {{csrf_field()}}
                <table class="table">
                    <tr><td>Nazwa</td><td>Email</td><td>Utworzony</td><td>Zmień email</td><td>Zmień Hasło</td></tr>
                    @foreach($user as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><div class="form-group">
                                    <input type="email" name="mail">
                                </div></td>
                            <td><div class="form-group">
                                    <input type="password" name="pwd">
                                </div></td>
                        </tr>
                        @endforeach
                </table>
                <br />
                <input type="submit" class="btn btn-info" value="Zatwierdź zmiany">
            </form>
            <div><a href="/usermanager/disable/{{$id}}"><button class="btn btn-danger">Zdezaktywuj użytkownika</button></a></div>
            <div><a href="/usermanager/"><button class="btn btn-default">Wróć</button></a></div>
        </div>

    </div>
@endsection