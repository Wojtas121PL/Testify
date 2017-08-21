@extends('groupmanager::layouts.master')
<script type="text/javascript">
    function searchUser(user) {
        var type=['user','group'];
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
                    <option value="0">Nazwie Użytkownika</option>
                    <option value="1">Nazwie Grupy</option>
                </select>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr><td>Lp.</td><td>Nazwa grupy</td><td>Użytkownicy</td><td> </td><td> </td></tr>
        @php($i=1)
        @foreach($Groups as $group)
            <tr>
            <td>{{$i}}</td>
            <td class="group">{{$group->group_name}}</td>
                <td class="user">
                    @foreach($UsersGroup as $userGroup)
                        @if($userGroup->role == 3)
                            @if($userGroup->group_name == $group->group_name)
                                <span>{{$userGroup->name}}</span>
                            @endif
                        @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{route('group.edit.show',$group->id)}}"><button class="btn btn-info">Edytuj</button></a>
                </td>
                <td>
                    <a href="{{route('group.delete',$group->id)}}"><button class="btn btn-danger">Skasuj</button></a>
                </td>
            </tr>
            @php($i++)
        @endforeach
    </table>

    <a href="{{route('group.add.show')}}"><button type="button" class="btn btn-success">Dodaj grupę</button></a>
@stop
