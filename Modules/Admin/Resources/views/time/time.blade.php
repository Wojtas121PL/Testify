@extends('admin.layouts.app')
@section('content')
    @parent

@isset($userTime)
    @if(session('done') == 'yes')
        <div class="alert alert-success">Expire time has deleted</div>
        @endif
    <div>
    <table class="table">
        <tr><td>User</td><td>Test</td><td>Time to expire</td></tr>
    @foreach($userTime as $item)
            <tr>
                <td>{{$item->user}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->expireTime}}</td>
                <td><a href="./delete/{{$item->id}}/"><button class="btn btn-danger">Delete</button></a></td>
            </tr>
    @endforeach
    </table>
        <a href="{{url('admin/time/add')}}"><button class="btn btn-success">Add</button></a>
        <a href="{{url('admin/time/edit')}}"><button class="btn btn-info">Edit</button></a>
    </div>
@endisset
@endsection