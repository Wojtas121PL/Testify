@extends('admin::layouts.master')
@section('content')
    @parent
        <form action="{{url('result/admin')}}" method="post">
            {{ csrf_field() }}
        <div class="form-group">
        <label for="SelectUser">Select User</label><br>
        <select id="SelectUser" class="form-control" name="SelectedUser">
            @if(isset($Choose))
                <span> {{$Choose}}</span>
                @foreach($Users as $user)
                    @if($Choose == $user->id)
                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                    @else
                        <option value="{{$user->id}}" >{{$user->name}}</option>
                        @endif
                @endforeach
            @else
                    @foreach($Users as $user)
                            <option value="{{$user->id}}" >{{$user->name}}</option>
                    @endforeach
                @endif
        </select>
        </div>
            <br />
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Search Result">
            </div>
        </form>
    @if(isset($Tests))
    <h1>Result table</h1>
    <table class="table">
        <tr><td>Test Id</td><td>Test name</td><td>Link to</td></tr>
@foreach($Tests as $Test)
    <tr><td>{{$Test->exam_id}}</td><td>{{$Test->name}}</td><td><a href="{{url('result/admin/'.$Choose.'/'.$Test->exam_id)}}">Go to test</a></td></tr>
    @endforeach
    </table>
    @endif
@endsection