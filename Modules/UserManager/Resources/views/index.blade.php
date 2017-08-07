@extends('usermanager::layouts.master')
<script type="text/javascript">
    function searchUser(user) {
        if (user.length > 0) {
            $("td.user").parent().hide();
            $("td.user:contains(" + user + ")").parent().show();
        }
        else {
            $("td.user").parent().show();
        }
    }
    function searchEmail(user) {
        if (user.length > 0) {
            $("td.email").parent().hide();
            $("td.email:contains(" + user + ")").parent().show();
        }
        else {
            $("td.email").parent().show();
        }
    }
</script>
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
        <div class="form-group">
            <input type="text" name="user" placeholder="Szukaj użytkownika" class="form-control" onkeyup="searchUser(this.value);searchEmail(this.value)"/>
        </div>
        <table class="table table-bordered">
            <tr><td>Lp.</td><td>Nazwa</td><td>Email</td><td>Rola</td><td>Utworzony</td><td>Zaaktulizowany</td></tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td class="user">{{$user->name}}</td>
                    <td class="email">{{$user->email}}</td>
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
                    <td><a href="{{url('/usermanager/edit/'.$user->id)}}"><button class="btn btn-info">Edytuj</button></a></td>
                </tr>
            @endforeach
        </table>
        <a href="{{url('usermanager/addUser')}}"><button class="btn btn-success">Dodaj</button></a>
    </div>
@stop
