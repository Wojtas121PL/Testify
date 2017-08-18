<form method="post" action="{{route('question.update', $exam->id)}}">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <input type="hidden" name="question_number" value="{{$question->question_number}}">
    <input type="hidden" name="question_type" value="{{$question->question_type}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><input class="form-control" type="text" name="question_title" value="{{$question->question_title}}"></h4>
        </div>

        <div class="panel-body">
            @foreach($question->answers as $i => $answer )
                @php($i++)
                @if($question->question_type == 1)
                    @if($i == $question->answer_correct)
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
                @endif
                    @if($question->question_type == 3)
                            @foreach($AnswerCorrect as $value)
                                    @if($i == $value->answer)
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="answer_correct" value="{{$i}}" checked>
                                            </span>
                                            <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$answer->answer}}">
                                        </div>
                                    @else
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input type="checkbox" name="answer_correct" value="{{$i}}">
                                            </span>
                                            <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$answer->answer}}">
                                        </div>
                                    @endif
                            @endforeach
                    @endif
            @endforeach


        </div>

        <div class="panel-footer">
            <button class="btn btn-info" type="submit">Zapisz</button>
            <a class="btn btn-warning" href="{{url('admin/exam/'.$exam->id)}}">Anuluj</a>
            @if($question->question_type == 1)
                <button class="btn btn-info" type="button">Zmień na Otwarty typ pytania</button>
                <button class="btn btn-info" type="button">Zmień na Wielokrotnego wyboru typ pytania</button>
                <button class="btn btn-info" type="button" onclick="//addRadio()">Dodaj odpowiedz</button>
                <button class="btn btn-info" type="button" onclick="//delRadio()">Usun odpowiedz</button>
                @endif
            @if($question->question_type == 2)
                <button class="btn btn-info" type="button">Zmień na ABC typ pytania</button>
                <button class="btn btn-info" type="button">Zmień na Wielokrotnego wyboru typ pytania</button>
            @endif
            @if($question->question_type == 3)
                <button class="btn btn-info" type="button">Zmień na Otwarty typ pytania</button>
                <button class="btn btn-info" type="button">Zmień na ABC typ pytania</button>
                <button class="btn btn-info" type="button" onclick="//addCheck()">Dodaj odpowiedz</button>
                <button class="btn btn-info" type="button" onclick="//delCheck()">Usun odpowiedz</button>
            @endif
        </div>
</div>
</form>

