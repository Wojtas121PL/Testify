@extends('usermanager::layouts.master')
<script type="text/javascript">
    function searchUser(user) {
        var type=['user','email','role','group'];
        var val=$('#pulldown').val();
        if (user.length > 0) {
            $("td."+type[val]).parent().hide();
            $("td."+type[val]+":contains(" + user + ")").parent().show();
        }
        else {
            $("td."+type[val]).parent().show();
        }
    }
    </script>
@section('content')
    @if(null != session('delete'))
            <div class="alert alert-success">Usunięto użytkownika {{session('delete')}}</div>
        @endif
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="user" placeholder="Szukaj użytkownika" class="form-control" onkeyup="searchUser(this.value)"/>
                </div>
                <div class="col-md-1" style="position: relative;top:10px;">
                    Po
                </div>
                <div class="col-md-3">
                    <select class="form-control" id="pulldown">
                        <option value="0">Nazwie</option>
                        <option value="1">Emailu</option>
                        <option value="2">Roli</option>
                        <option value="3">Grupie</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tr><td>Lp.</td><td>Nazwa</td><td>Email</td><td>Rola</td><td>Grupa</td><td>Utworzony</td><td>Zaaktulizowany</td></tr>
            @foreach($users as $user)
                @php($i=0)
                <tr>
                    <td>{{$user->id}}</td>
                    <td class="user">{{$user->name}}</td>
                    <td class="email">{{$user->email}}</td>
                    @if($user->role == 0)
                        <td class="role">Konto nieaktywne</td>
                    @endif
                    @if($user->role == 1)
                        <td class="role">Administrator</td>
                    @endif
                    @if($user->role == 2)
                        <td class="role">Edytor</td>
                    @endif
                    @if($user->role == 3)
                        <td class="role">Użytkownik</td>
                    @endif
                    <td class="group">
                        @foreach($groupsOfUsers as $groupOfUser)
                            @if($user->id == $groupOfUser->user_id)
                                <span>{{$groupOfUser->group_name}}</span>
                                @php($i++)
                            @endif
                        @endforeach
                    @if($i == 0)
                        Brak
                    @endif
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><a href="{{url('/usermanager/edit/'.$user->id)}}"><button class="btn btn-info">Edytuj</button></a></td>
                </tr>
            @endforeach
        </table>
        <a href="{{url('usermanager/addUser')}}"><button class="btn btn-success">Dodaj użytkownika</button></a>
    </div>
@stop
