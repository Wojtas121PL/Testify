@extends('layouts.app')

@section('menu')
    @parent
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="active"><a href="./">Home</a></li>
        <li role="presentation"><a href="./adduser">Add User</a></li>
        <li role="presentation"><a href="./addquestion">Add Question</a></li>
    </ul>
@endsection

@section('content')
    @parent
dd{{user}}
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam animi assumenda corporis eius laborum maxime odit soluta vel. Autem consequuntur laudantium magni maiores minima nemo perspiciatis quasi quod sunt.
@endsection