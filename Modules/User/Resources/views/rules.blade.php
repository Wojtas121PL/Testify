@extends('user::layouts.master')

@section('content')
    @parent
    Zasady i informacje ogólne
    <div class="panel">
        <pre class="pre-scrollable">{{$examContent->rules_page_text}}</pre>
    </div>
    <div class="panel">
        <a href="{{route('user.exam.action',$id)}}"><button class="btn btn-success">Przejdź do egzaminu</button></a>
        <a href="{{route('user.index')}}"><button class="btn btn-danger">Anuluj</button></a>
    </div>
@endsection
