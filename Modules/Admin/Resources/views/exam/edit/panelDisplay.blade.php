
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{$question->question_title}}</h4>
    </div>
    <div class="panel-body">

            @foreach($question->answers as $i => $answer )
                <div class="input-group">
                    <span class="input-group-addon">{{++$i}}:</span>
                    <div class="form-control">{{$answer->answer}}</div>
                </div>
            @endforeach

    </div>

    <div class="panel-footer">
        <form action="{{route('admin.exam.edit', $exam->id)}}" method="get">
            <input type="hidden" name="edit_id" value="{{$question->id}}">
            <button class="btn btn-info" type="submit">Edit</button>
        </form>
        <form action="{{route('question.destroy', $exam->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input type="hidden" name="question_id" value="{{$question->id}}">

            <button style="position: relative;bottom: 35px;" class="btn btn-danger pull-right" type="submit">Delete</button>
        </form>

    </div>
</div>