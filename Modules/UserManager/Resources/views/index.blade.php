@extends('usermanager::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('usermanager.name') !!}
    </p>
    <div>
        <h3>Simply menu before Refactor</h3>
        <a href="{{url('/usermanager/addUser')}}">Add User</a>
        <a href="{{url('/usermanager/deleteUser')}}">Delete User</a>
        <a href="{{url('/usermanager/changePwd')}}">Change Password</a>
        <a href="{{url('/usermanager/changeEmail')}}">Change Email</a>
    </div>
@stop
