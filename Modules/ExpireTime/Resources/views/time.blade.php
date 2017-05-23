@extends('expiretime::layouts.master')

@section('content')
    @parent

    @isset($userTime)
        @if(session('done') == 'yes')
            <div class="alert alert-success">Expired time has been deleted</div>
        @endif
        <div>
            <table class="table">
                <tr><td>User</td><td>Test</td><td>Time expired</td></tr>
                @foreach($userTime as $item)
                    <tr>
                        <td>{{$item->user}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->expireTime}}</td>
                        <td><a href="{{url('expiretime/delete/'.$item->id)}}"><button class="btn btn-danger">Delete</button></a></td>
                    </tr>
                @endforeach
            </table>
            <a href="{{url('expiretime/add')}}"><button class="btn btn-success">Add</button></a>
            <a href="{{url('expiretime/edit')}}"><button class="btn btn-info">Edit</button></a>
        </div>
    @endisset
@endsection