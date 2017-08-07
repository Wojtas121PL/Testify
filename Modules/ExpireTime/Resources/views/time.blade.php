@extends('expiretime::layouts.master')
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
    @parent

    @isset($userTime)
        @if(session('done') == 'yes')
            <div class="alert alert-success">Czas dostępu został usunięty</div>
        @endif
        <div>
            <div class="form-group">
                <input type="text" name="user" placeholder="Szukaj użytkownika" class="form-control" onkeyup="searchUser(this.value);searchEmail(this.value)"/>
            </div>
            <table class="table">
                <tr><td>Użytkownik</td><td>Email</td><td>Test</td><td>Czas dostępu</td></tr>
                @foreach($userTime as $item)
                    <tr>
                        <td class="user">{{$item->user}}</td>
                        <td class="email">{{$item->email}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->expireTime}}</td>
                        <td><a href="{{url('expiretime/delete/'.$item->id)}}"><button class="btn btn-danger">Usuń</button></a></td>
                    </tr>
                @endforeach
            </table>
            <a href="{{url('expiretime/add')}}"><button class="btn btn-success">Dodaj!</button></a>
            <a href="{{url('expiretime/edit')}}"><button class="btn btn-info">Edytuj!</button></a>
        </div>
    @endisset
@endsection