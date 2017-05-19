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
        @if(session('done') == 'yes')
            <div class="alert alert-success">
                Email changed
            </div>
        @endif
        @if(session('done') == 'nothing')
            <div class="alert alert-warning">
                Nothing to change
            </div>
        @endif
        <div class="panel-body">

            <div>
                <div class="form-group">
                    <label for="name">User list</label>
                    <form action="{{url('/usermanager/changeEmail')}}" method="post">
                        {{csrf_field()}}
                        <table class="table">
                            <tr><td>Name</td><td>Email</td><td>Created At</td><td>Change Email</td></tr>
                            @foreach($userList as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td><div class="form-group">
                                            <input type="email" name="mail[{{$user->id}}][emails]">
                                        </div></td>
                                </tr>
                            @endforeach
                        </table>
                        <input type="submit" class="btn btn-info" value="Change">
                    </form>
                </div>
                <a href="/usermanager/"><button class="btn btn-default">Back</button></a>
            </div>
        </div>
@endsection