@extends('expiretime::layouts.master')

@section('content')
    @parent

    @isset($userTime)
        @if(session('done') == 'yes')
            <div class="alert alert-success">Czas dostępu został usunięty</div>
        @endif
        <div>
            <table class="table">
                <tr><td>Użytkownik</td><td>Test</td><td>Czas dostępu</td></tr>
                @foreach($userTime as $item)
                    <tr>
                        <td>{{$item->user}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->expireTime}}</td>
                        <td><a href="{{url('expiretime/delete/'.$item->id)}}"><button class="btn btn-danger">Usuń</button></a></td>
                    </tr>
                @endforeach
            </table>
            <a href="{{url('expiretime/add')}}"><button class="btn btn-success">Dodaj!</button></a>
            <a href="{{url('expiretime/edit')}}"><button class="btn btn-info">Edytuj!</button></a>
        </div>
    @endisset
@endsection