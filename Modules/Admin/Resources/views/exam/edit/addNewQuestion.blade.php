
<form action="{{route('question.store')}}" method="post">
        {{ csrf_field() }}
    <input type="hidden" name="exam_id" value="{{$exam->id}}">
    <div class="form-group">
       <label for="Question">Title</label>
       <input type="text" class="form-control" id="Question" name="question_title">
    </div>
    <div class="form-group">
       <label for="Answer">Answers</label>
        <div class="input-group">
            <span class="input-group-addon">1:</span>
            <input type="Text" class="form-control" id="answer1" name="answer1">
        </div>
        <div class="input-group">
            <span class="input-group-addon">2:</span>
            <input type="Text" class="form-control" id="answer2" name="answer2">
        </div>
        <div class="input-group">
            <span class="input-group-addon">3:</span>
            <input type="Text" class="form-control" id="answer3" name="answer3">
        </div>
        <div class="input-group">
            <span class="input-group-addon">4:</span>
            <input type="Text" class="form-control" id="answer4" name="answer4">
        </div>
    </div>
    <div class="form-group">
      <label for="AnswerKey">Correct Answer ( 1, 2, 3, 4 )</label><br>
      <input type="Number" min="1" max="4" class="form-control" id="AnswerKey" name="answer_correct">
    </div>
    <div class="form-group">
      <button class="btn btn-success" type="submit">Add!</button>
    </div>
</form>
