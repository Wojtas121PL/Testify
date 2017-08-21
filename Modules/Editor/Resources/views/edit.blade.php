@extends('editor::layouts.master')

@section('content')
    @parent
    @if(session('done') == 'yes')
        <div class="alert alert-success">Zmiany zapisane</div>
    @endif
    @if(session('done') == 'nothing')
        <div class="alert alert-warning">Brak zmian</div>
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
        <form action="{{route('editor.expire.edit.action')}}" method="post">
            {{csrf_field()}}
            <table class="table">
                <tr><td>Nazwa użytkownika</td><td>Nazwa testu</td><td>Czas wygaśnięcia</td></tr>
                @foreach($userTime as $itemTime)
                    <tr>
                        <td>
                            <select name="edits[{{$itemTime->id}}][user]">
                                @foreach($Users as $itemUser)
                                    @if($itemTime->user == $itemUser->name)
                                        <option value="{{$itemUser->id}}" selected>{{$itemUser->name}}</option>
                                    @else
                                        <option value="{{$itemUser->id}}">{{$itemUser->name}}</option>
                                    @endif
                                @endforeach
                            </select>

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
        <a href="{{route('editor.expire.index')}}"><button class="btn btn-danger">Wróć</button></a>
    </div>

@endsection