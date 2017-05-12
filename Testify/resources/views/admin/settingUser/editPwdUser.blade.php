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
            <a href="/admin/setting/"><button class="btn btn-default">Back</button></a>
            @isset($done)
                <div class="bg-success">
                    Password changed
                </div>
            @endisset
                <div class="form-group">
                    <label for="name">User list</label>
                    <table class="table">
                        <tr><td>Name</td><td>Email</td><td>Created At</td><td>Change Password</td></tr>
                    @foreach($userList as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><div class="form-group">
                                        <form action="{{url('/admin/setting/changePwd')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="password" name="pwd">
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <input type="submit" class="btn btn-info" value="Change">
                                        </form>
                                    </div></td>
                            </tr>
                    @endforeach
                    </table>
                </div>
        </div>
    </div>
@endsection