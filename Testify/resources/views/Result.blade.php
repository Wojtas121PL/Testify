@extends('layouts.app')
@section('content')
    @parent
        <form action="./result" method="post">
            {{ csrf_field() }}
        <div class="form-group">
        <label for="SelectUser">Select User</label><br>
        <select id="SelectUser" name="SelectedUser">
            @foreach($Users as $user)
                <option>
        {{$user->id}}<br/>
                @endforeach

                </option>
        </select>
        </div>
            <br />
            <div class="form-group">
                <input type="submit" value="Search Result">
            </div>
        </form>
    @if(isset($Answers))
    <h1>Result table</h1>
    <table border="4px">
        <tr><td>Test Name</td><td>User</td><td>Question Number</td><td>Answer</td><td>Correct Answer</td><td>Created</td></tr>
@foreach($Answers as $answer)
    <tr><td>{{$answer->ExamName}}</td><td>{{$answer->name}}</td><td>{{$answer->QuestionId}}</td><td>{{$answer->Answer}}</td><td>{{$answer->CorrectAnswer}}</td><td>{{$answer->created_at}}</td></tr>
    @endforeach
    </table>
    @endif
@endsection