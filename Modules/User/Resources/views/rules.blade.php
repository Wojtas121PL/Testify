@extends('user::layouts.master')

@section('content')
    @parent
    Zasady i informacje ogólne
    <div class="container">
        <pre class="pre-scrollable">{{$examContent->rules_page_text}}</pre>
    </div>
@endsection
