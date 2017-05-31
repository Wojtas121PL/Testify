@extends('usermanager::layouts.master')

@section('content')
    <div>
        <table class="table table-bordered">
            <tr><td>Id.</td><td>Name</td><td>Email</td><td>Role</td><td>Created at</td><td>Updated at</td></tr>
            @php
                $arrayRole=array("Admin" => 1,"Editor"=>2,"User"=>3);
            @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if($user->role == 1)
                        <td>Admin</td>
                    @endif
                    @if($user->role == 2)
                        <td>Editor</td>
                    @endif
                    @if($user->role == 3)
                        <td>User</td>
                    @endif
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><a href="{{url('/usermanager/edit/'.$user->id)}}"><button class="btn btn-info">Change</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
