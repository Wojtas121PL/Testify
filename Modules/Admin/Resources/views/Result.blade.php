@extends('admin::layouts.master')
@section('content')
    @parent
        <form action="{{url('result.admin.test.action')}}" method="post">
            {{ csrf_field() }}
        <div class="form-group">
        <label for="SelectUser">Wybierz użytkownika</label><br>
        <select id="SelectUser" class="form-control" name="SelectedUser">
            @if(isset($Choose))
                <span> {{$Choose}}</span>
                @foreach($Users as $user)
                    @if($user->role == 3)
                    @if($Choose == $user->id)
                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}" >{{$user->name}}</option>
                        @endif
                    @endif
                @endforeach
            @else
                    @foreach($Users as $user)
                        @if($user->role == 3)
                            <option value="{{$user->id}}" >{{$user->name}}</option>
                    @endif
                    @endforeach
                @endif
        </select>
        </div>
            <br />
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Szukaj rezultatów">
            </div>
        </form>
    @if(isset($Tests))
    <h1>Tabela rezultatów</h1>
    <table class="table">
        <tr><td>Lp.</td><td>Nazwa Testu</td><td>Idź do</td></tr>
@foreach($Tests as $Test)
    <tr><td>{{$Test->exam_id}}</td><td>{{$Test->name}}</td><td><a href="{{url('result/admin/'.$Choose.'/'.$Test->exam_id)}}">Idź do testu</a></td></tr>
    @endforeach
    </table>
    @endif
@endsection