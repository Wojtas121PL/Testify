@extends('expiretime::layouts.master')
@section('content')
    @parent
    <div>
        @if(session('done') == 'yes')
            <div class="alert alert-success">Czas dostępu został dodany</div>
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
        <form action="{{route('expire.add.action')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="Ename">Nazwa egzaminu</label>
                <select name="examId" class="form-control">
                    @foreach($Exam as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Uname">Nazwa użytkownika</label>
                @foreach($Users as $user)
                        <input type="checkbox" name="user[{{$user->id}}][check]">{{$user->name}}
                @endforeach
            </div>
            <div class="form-group">
                <label for="Gname">Nazwa grupy</label>
                @foreach($Groups as $group)
                    <input type="checkbox" name="group[{{$group->id}}][check]">{{$group->group_name}}
                @endforeach
            </div>
            <div class="form-group">
                <label for="data">Data (Szablon: YYYY-MM-DD HH-MM-SS)</label>
                <input type="datetime-local" value="{{$now}}" name="data">
            </div>
            <div class="form-group">
                <input type="submit" value="Zapisz" class="btn btn-success">
            </div>
        </form>
            <a href="{{route('expire.index')}}"><button class="btn btn-default">Wróć</button></a>
    </div>
@endsection