@extends('admin.layouts.app')


@section('content')
    @parent
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="./addUser">Add User</a></li>
                        <li><a href="./deleteUser">Delete User</a></li>
                        <li><a href="./changePwd">Change Password</a></li>
                        <li><a href="./changeEmail">Change Email</a></li>
                    </ul>
                </div>
            </div>
@endsection