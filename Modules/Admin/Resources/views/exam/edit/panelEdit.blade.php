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
                @if(++$i == $question->answer_correct)
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="answer_correct" value="{{$i}}" checked>
                    </span>
                    <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$answer->answer}}">
                </div>
                @else
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="answer_correct" value="{{$i}}" >
                        </span>
                        <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$answer->answer}}">
                    </div>
                    @endif
            @endforeach


        </div>

        <div class="panel-footer">
            <button class="btn btn-info" type="submit">Zapisz</button>
            <a class="btn btn-warning" href="{{url('admin/exam/'.$exam->id)}}">Anuluj</a>
        </div>
</div>
</form>

