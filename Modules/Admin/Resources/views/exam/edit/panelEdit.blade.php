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
            @php($show = false)
            @foreach($question->answers as $i => $item )
                @php($i++)
                @if($question->question_type == 1)
                    @if($i == $question->answer_correct)
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" name="answer_correct" value="{{$i}}" checked>
                        </span>
                        <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$item->answer}}">
                    </div>
                    @else
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="answer_correct" value="{{$i}}" >
                            </span>
                            <input type="Text" class="form-control" name="answers[{{$i}}]" value="{{$item->answer}}">
                        </div>
                    @endif
                @endif
                    @if($question->question_type == 3)
                        @php($counter = 1)
                        @foreach($answers as $answer)
                            @if($show == false)
                                @if($answer->correct == "true")
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" name="answer_correct[{{$counter}}][check]" checked>
                                            <input type="hidden" name="answer_correct[{{$counter}}][set]" value="1">
                                        </span>
                                    <input type="Text" class="form-control" name="answers[{{$counter}}][answer]" value="{{$answer->answer}}">
                                    </label>
                                @else
                                    <label class="input-group">
                                        <span class="input-group-addon">
                                            <input type="checkbox" name="answer_correct[{{$counter}}][check]">
                                            <input type="hidden" name="answer_correct[{{$counter}}][set]" value="0">
                                        </span>
                                        <input type="Text" class="form-control" name="answers[{{$counter}}][answer]" value="{{$answer->answer}}">
                                    </label>
                                @endif
                            @endif
                            @php($counter++)
                        @endforeach
                            @php($show = true)
                    @endif
            @endforeach


        </div>

        <div class="panel-footer">
            <button class="btn btn-info" type="submit">Zapisz</button>
            <a class="btn btn-warning" href="{{route('admin.exam.id',$exam->id)}}">Anuluj</a>
            @if($question->question_type == 1)
                <button class="btn btn-info" type="button" disabled>Zmień na Otwarty typ pytania</button>
                <button class="btn btn-info" type="button" disabled>Zmień na Wielokrotnego wyboru typ pytania</button>
                <button class="btn btn-info" type="button" onclick="//addRadio()" disabled>Dodaj odpowiedz</button>
                <button class="btn btn-info" type="button" onclick="//delRadio()" disabled>Usun odpowiedz</button>
                @endif
            @if($question->question_type == 2)
                <button class="btn btn-info" type="button" disabled>Zmień na ABC typ pytania</button>
                <button class="btn btn-info" type="button" disabled>Zmień na Wielokrotnego wyboru typ pytania</button>
            @endif
            @if($question->question_type == 3)
                <button class="btn btn-info" type="button" disabled>Zmień na Otwarty typ pytania</button>
                <button class="btn btn-info" type="button" disabled>Zmień na ABC typ pytania</button>
                <button class="btn btn-info" type="button" onclick="//addCheck()" disabled>Dodaj odpowiedz</button>
                <button class="btn btn-info" type="button" onclick="//delCheck()" disabled>Usun odpowiedz</button>
            @endif
        </div>
</div>
</form>

