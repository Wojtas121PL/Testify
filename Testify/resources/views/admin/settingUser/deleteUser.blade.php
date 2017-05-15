@extends('admin.layouts.app')


@section('content')
    @parent
    <div class="panel panel-default">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-body">
            @if(session('done') == 'yes')
                <div class="alert alert-success">
                    User deleted
                </div>
            @endif
            @if(session('done') == 'root')
                    <div class="alert alert-danger">
                        You must not delete root account
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">User list</label>
                    <table class="table">
                        <tr><td>Name</td><td>Email</td><td>Created At</td><td>Delete</td></tr>
                    @foreach($userList as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><div class="btn-group"><a href="./deleteUser/{{$user->id}}"><button class="btn btn-danger">Delete</button></a></div></td>
                            </tr>
                    @endforeach
                    </table>
                </div>
                <a href="/admin/setting/"><button class="btn btn-default">Back</button></a>
        </div>
    </div>
@endsection