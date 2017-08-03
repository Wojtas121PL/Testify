@extends('expiretime::layouts.master')
@section('content')
    @parent
    <div>
        @if(session('done') == 'yes')
            <div class="alert alert-success">Czas dostępu został dodany</div>
        @endif
        @if(session('exist') == 'yes')
                <div class="alert alert-danger">Czas dostępu został ustawiony danemu użytkownikowi</div>
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
        <form action="{{url('/expiretime/add')}}" method="post">
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
                <select name="userId" class="form-control">
                    @foreach($Users as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="data">Data (Szablon: YYYY-MM-DD HH-MM-SS)</label>
                <input type="datetime-local" value="{{$now}}" name="data">
            </div>
            <div class="form-group">
                <input type="submit" value="Zapisz" class="btn btn-success">
            </div>
        </form>
            <a href="/expiretime/"><button class="btn btn-default">Wróć</button></a>
    </div>
@endsection