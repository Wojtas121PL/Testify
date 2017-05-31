@extends('usermanager::layouts.master')

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
    <div>
        <div class="form-group">
            <form action="{{url('')}}" method="post">
                {{csrf_field()}}
                <table class="table">
                    <tr><td>Name</td><td>Email</td><td>Created At</td><td>Change Email</td><td>Change Password</td></tr>
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td><div class="form-group">
                                    <input type="email" name="mail[{{$user->id}}][emails]">
                                </div></td>
                            <td><div class="form-group">
                                    <input type="password" name="pwd[{{$user->id}}][pwd]">
                                </div></td>
                        </tr>
                </table>
                <input type="submit" class="btn btn-info" value="Change">
            </form>

        </div>
        <a href="/usermanager/"><button class="btn btn-default">Back</button></a>
        <a href="#"><button class="btn btn-danger">Disable User</button></a>
    </div>
@endsection