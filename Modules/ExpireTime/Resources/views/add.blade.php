@extends('expiretime::layouts.master')
@section('content')
    @parent
    <div>
        @if(session('done') == 'yes')
            <div class="alert alert-success">Expired time has been added</div>
        @endif
        @if(session('exist') == 'yes')
                <div class="alert alert-danger">User has expire time for this test</div>
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
                <label for="Ename">Exam name</label>
                <select name="examId" class="form-control">
                    @foreach($Exam as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Uname">User name</label>
                <select name="userId" class="form-control">
                    @foreach($Users as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="data">Date (Template: YYYY-MM-DD HH-MM-SS)</label>
                <input type="datetime-local" value="{{$now}}" name="data">
            </div>
            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection