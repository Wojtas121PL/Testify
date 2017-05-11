<form action="{{url('admin/addQuestion/'. $id)}}" method="post">
        {{ csrf_field() }}

    <div class="form-group">
       <label for="Question">Title</label>
       <input type="text" class="form-control" id="Question" name="question_title">
    </div>
    <div class="form-group">
       <label for="Answer">Answers</label><br>
       1:<input type="Text" class="form-control" id="answer1" name="answer1"><br>
       2:<input type="Text" class="form-control" id="answer2" name="answer2"><br>
       3:<input type="Text" class="form-control" id="answer3" name="answer3"><br>
       4:<input type="Text" class="form-control" id="answer4" name="answer4"><br>
    </div>
    <div class="form-group">
      <label for="AnswerKey">Correct Answer ( 1, 2, 3, 4 )</label><br>
      <input type="Number" min="1" max="4" class="form-control" id="AnswerKey" name="answer_correct">
    </div>
    <div class="form-group">
      <label for="Submit">Submit</label><br>
      <input type="submit">Submit!
    </div>
</form>
