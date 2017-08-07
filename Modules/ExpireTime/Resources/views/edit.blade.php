@extends('expiretime::layouts.master')
<script type="text/javascript">
    function searchUser(user) {
        if (user.length > 0) {
            $(".user option:selected").parent().parent().parent().hide();
            $(".user option:selected:contains("+user+")").parent().parent().parent().show();
        }
        else {
            $( ".user option:selected" ).parent().parent().parent().show();
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
    @if(session('done') == 'yes')
        <div class="alert alert-success">Changes saved</div>
    @endif
    @if(session('done') == 'nothing')
        <div class="alert alert-warning">Nothing to change</div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <div class="form-group">
            <input type="text" name="user" placeholder="Szukaj użytkownika" class="form-control" onkeyup="searchUser(this.value);searchEmail(this.value)"/>
        </div>
        <form action="{{url('expiretime/edit')}}" method="post">
            {{csrf_field()}}
            <table class="table">
                <tr><td>Nazwa użytkownika</td><td>Email</td><td>Nazwa egzaminu</td><td>Czas dostępu:</td></tr>
                @foreach($userTime as $itemTime)
                    <tr>
                        <td>
                            <select class="user" name="edits[{{$itemTime->id}}][user]">
                                @foreach($Users as $itemUser)
                                    @if($itemTime->user == $itemUser->name)
                                        <option value="{{$itemUser->id}}" selected>{{$itemUser->name}}</option>
                                    @else
                                        <option value="{{$itemUser->id}}">{{$itemUser->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        <td class="email">{{$itemTime->email}}</td>
                        <td>
                            <select name="edits[{{$itemTime->id}}][exam]">
                                @foreach($Exam as $itemExam)
                                    @if($itemTime->name == $itemExam->name)
                                        <option value="{{$itemExam->id}}" selected>{{$itemExam->name}}</option>
                                    @else
                                        <option value="{{$itemExam->id}}">{{$itemExam->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="edits[{{$itemTime->id}}][data]" placeholder="0000-00-00 00:00:00" value="{{$itemTime->expireTime}}">
                        </td>
                    </tr>
                @endforeach
            </table>
            <input type="submit" class="btn btn-success" value="Zmień">
        </form>
        <br/>
        <a href="{{url('/expiretime/')}}"><button class="btn btn-danger">Wróć</button></a>
    </div>

@endsection