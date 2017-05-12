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
            <div>
            <a href="/admin/setting/"><button class="btn btn-default">Back</button></a>
                @if(null !==session('done'))
                    <div class="bg-success">
                        Email changed
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">User list</label>
                    <table class="table">
                        <tr><td>Name</td><td>Email</td><td>Created At</td><td>Change Email</td></tr>
                    @foreach($userList as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td><div class="form-group">
                                        <form action="{{url('/admin/setting/changeEmail')}}" method="post">
                                            {{csrf_field()}}
                                            <input type="email" name="userEmail">
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