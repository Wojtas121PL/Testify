<input type="hidden" name="answer[{{$question->id}}][typeId]" value="{{$question->question_type}}">
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{$question->question_title}}</h4>
    </div>
    <div class="panel-body">
        @if($question->question_type == 1)
            @foreach($question->answers as $i => $answer )
                <label class="input-group">
                    <span class="input-group-addon"><input type="radio" name="answer[{{$question->id}}][number]" value="{{++$i}}" ></span>
                    <div class="form-control">{{$answer->answer}}</div>
                </label>
            @endforeach
        @endif
        @if($question->question_type == 2)
            <label class="input-group">
                <textarea name="answer[{{$question->id}}][number]" placeholder="Napisz swoją odpowiedź tutaj..."></textarea>
            </label>
        @endif
        @if($question->question_type == 3)
            @php($counter=1)
                @foreach($question->answers as $i => $answer )
                    <label class="input-group">
                        <span class="input-group-addon"><input type="checkbox" name="answer[{{$question->id}}][{{$counter}}][check]"></span>
                        <div class="form-control">{{$answer->answer}}</div>
                    </label>
                    @php($counter++)
                @endforeach
        @endif
    </div>
</div>
