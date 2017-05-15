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
            @if(session('done') == 'yes')
                <div class="alert alert-success">
                    Password changed
                </div>
            @endif
            @if(session('done') == 'nothing')
                <div class="alert alert-warning">
                    Nothing to change
                </div>
            @endif
        <div class="panel-body">
                <div class="form-group">
                    <label for="name">User list</label>
                    <form action="{{url('/admin/setting/changePwd')}}" method="post">
                        {{csrf_field()}}
                    <table class="table">
                        <tr><td>Name</td><td>Email</td><td>Created At</td><td>Change Password</td></tr>
                    @foreach($userList as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><div class="form-group">
                                            <input type="password" name="pwd[{{$user->id}}][pwd]">
                                    </div></td>
                            </tr>
                    @endforeach
                    </table>
                        <input type="submit" class="btn btn-info" value="Change">
                    </form>
                </div>
            <a href="/admin/setting/"><button class="btn btn-default">Back</button></a>
        </div>
    </div>
@endsection