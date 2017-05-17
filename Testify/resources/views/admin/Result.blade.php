@extends('admin.layouts.app')
@section('content')
    @parent
        <form action="{{url('admin/result')}}" method="post">
            {{ csrf_field() }}
        <div class="form-group">
        <label for="SelectUser">Select User</label><br>
        <select id="SelectUser" name="SelectedUser">
            @foreach($Users as $user)
                <option value="{{$user->id}}">{{$user->name}}
                </option>
                @endforeach
        </select>
        </div>
            <br />
            <div class="form-group">
                <input type="submit" value="Search Result">
            </div>
        </form>
    @if(isset($Tests))
    <h1>Result table</h1>
    <table class="table">
        <tr><td>Test Id</td><td>Test name</td><td>Link to</td></tr>
@foreach($Tests as $Test)
    <tr><td>{{$Test->TestId}}</td><td>{{$Test->name}}</td><td><a href="./result/{{$Choose}}/{{$Test->TestId}}">Go to test</a></td></tr>
    @endforeach
    </table>
    @endif
@endsection