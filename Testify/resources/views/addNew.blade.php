@extends('layouts.app)

@section('content')
    @parent
    <form action="/addQuestion" method="post">
        <input type="number" name="testId" >Test ID

    </form>

@endsection