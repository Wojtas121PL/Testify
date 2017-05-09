@extends('layouts.app')
@section('content')
    @parent
    <form action="/addQuestion" method="post">
        {{ csrf_field() }}
    <div class="form-group">
        <label for="TestId">Test Id:</label>
        <input type="number" min="1" max="100" class="form-control" id="TestId" name="TestId">
    </div>
    <div class="form-group">
        <label for="QuestionId">Question Id:</label>
        <input type="number" min="1" max="100" class="form-control" id="QuestionId" name="QuestionId">
    </div>
    <div class="form-group">
       <label for="QuestionType">Question Type(1):</label>
       <input type="number" min="1" max="1" class="form-control" id="QuestionType" name="QuestionType">
    </div>
    <div class="form-group">
       <label for="Question">Question</label>
       <input type="text" class="form-control" id="Question" name="Question">
    </div>
    <div class="form-group">
       <label for="Answer">Answers</label><br>
       A:<input type="Text" class="form-control" id="AnswerA" name="AnswerA"><br>
       B:<input type="Text" class="form-control" id="AnswerB" name="AnswerB"><br>
       C:<input type="Text" class="form-control" id="AnswerC" name="AnswerC"><br>
       D:<input type="Text" class="form-control" id="AnswerD" name="AnswerD"><br>
    </div>
    <div class="form-group">
      <label for="AnswerKey">Correct Answer ( A , B , C , D )</label><br>
      <input type="text" min="1" max="1" class="form-control" id="AnswerKey" name="AnswerKey">
    </div>
    <div class="form-group">
      <label for="Submit">Submit</label><br>
      <input type="submit">Submit!
    </div>
    </form>
@endsection