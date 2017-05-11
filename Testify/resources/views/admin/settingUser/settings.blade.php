@extends('admin.layouts.app')


@section('content')
    @parent
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#">Add User</a></li>
                        <li><a href="#">Create User</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="#">Change Email</a></li>
                    </ul>
                </div>
            </div>
@endsection