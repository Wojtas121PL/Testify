@extends('admin.layouts.app')
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
           1:<input type="Text" class="form-control" id="Answer1" name="Answer1"><br>
           2:<input type="Text" class="form-control" id="Answer2" name="Answer2"><br>
           3:<input type="Text" class="form-control" id="Answer3" name="Answer3"><br>
           4:<input type="Text" class="form-control" id="Answer4" name="Answer4"><br>
        </div>
        <div class="form-group">
          <label for="AnswerKey">Correct Answer ( 1, 2, 3, 4 )</label><br>
          <input type="Number" min="1" max="4" class="form-control" id="AnswerKey" name="AnswerKey">
        </div>
        <div class="form-group">
          <label for="Submit">Submit</label><br>
          <input type="submit">Submit!
        </div>
    </form>
@endsection