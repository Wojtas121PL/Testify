@extends('layouts.app')

@section('content')
    @parent
    <form action="/addQuestion" method="post">
        {{ csrf_field() }}
        <input type="number" name="TestId" aria-label="TestId">
        <input type="number" name="QuestionId">Question ID
        <input type="number" name="QuestionType">Question Type(1)
        <input type="text" name="Question">Content
        <input type="text" name="Answers">Answers as Json
        <input type="number" name="AnswerKey">Key (A,B,C,D)
        <hr/>
        <input type="submit">Submit!
    </form>

@endsection