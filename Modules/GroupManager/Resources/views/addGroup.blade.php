@extends('groupmanager::layouts.master')
<script type="text/javascript">
    function searchUser(user) {
        if (user.length > 0) {
            $("span.user").parent().hide();
            $("span.user:contains(" + user + ")").parent().show();
        }
        else {
            $("span.user").parent().show();
        }
    }
</script>
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(null != session('done'))
        @if(session('done') == 'yes')
            <div class="alert alert-success">Dodano nową grupę</div>
        @endif
        @if(session('done') == 'existGroupName')
            <div class="alert alert-danger">Podana grupa już istnieje</div>
        @endif
    @endif
    <div>
        <form method="post" action="{{route('storeGroup')}}">
            {{csrf_field()}}
        <div class="form-group">
            <input class="form-control" type="text" name="nameGroup" placeholder="Wpisz nazwę grupy">
        </div>
        <div class="form-group">
            Wybierz użytkowników do grupy
            <input type="text" id="user" placeholder="Szukaj użytkownika" class="form-control" onkeyup="searchUser(this.value)"/>
            @foreach($Users as $user)
                    <span><span class="user">{{$user->name}}</span>:<input type="checkbox" name="user[{{$user->id}}]"/></span><br />
            @endforeach
        </div>
        <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
@stop
