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
            @if(null !==session('done'))
                <div class="bg-success">
                    User added
                </div>
            @endif
            <form action="{{url('/admin/setting/addUser')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" id="name" name="nameUser">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="pwd">
                </div>
                <div class="form-group">
                    <label for="Role">Role:</label>
                    <select name="role">
                        <option>Admin</option>
                        <option>Editor</option>
                        <option>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection