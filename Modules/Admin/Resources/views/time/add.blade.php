@extends('admin.layouts.app')
@section('content')
    @parent
    <div>
        @if(session('done') == 'yes')
            <div class="alert alert-success">Expire time has added</div>
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
<form action="{{url('/admin/time/add')}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="Ename">Exam name</label>
        <select name="examId">
            @foreach($Exam as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="Uname">User name</label>
            <select name="userId">
                @foreach($Users as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="data">Date (Template: YYYY-MM-DD HH-MM-SS)</label>
<input type="text" placeholder="0000-00-00 00:00:00" name="data">
    </div>
    <div class="form-group">
    <input type="submit" value="Save">
    </div>
</form>
    </div>
@endsection