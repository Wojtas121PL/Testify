<form method="post" action="{{route('question.update', $exam->id)}}">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <input type="hidden" name="question_number" value="{{$question->question_number}}">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><input class="form-control" type="text" name="question_title" value="{{$question->question_title}}"></h4>
        </div>

        <div class="panel-body">
            @foreach($question->answers as $i => $answer )
                <div class="input-group">
                    <span class="input-group-addon">{{++$i}}:</span>
                    <input class="form-control" type="text" name="answers[{{$i}}]" value="{{$answer->answer}}">
                </div>
            @endforeach
            <input class="form-control" type="number" name="answer_correct" min="1" value="{{$question->answer_correct}}">

        </div>

        <div class="panel-footer">
            <button class="btn btn-info" type="submit">Save</button>
            <a class="btn btn-warning" href="{{url('admin/exam/'.$exam->id)}}">Cancel</a>
        </div>
</div>
</form>

