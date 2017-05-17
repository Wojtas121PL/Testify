@php
    $answers = json_decode($question->answer_list, true);
@endphp
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>{{$question->question_title}}</h4>
    </div>
    <div class="panel-body">

            @for($i = 1; $i <= count($answers); $i++)
                <div class="input-group">
                    <span class="input-group-addon">{{$i}}:</span>
                    <div class="form-control">{{$answers[$i]}}</div>
                </div>
            @endfor

    </div>

    <div class="panel-footer">
        <form action="{{url('/admin/editQuestion')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <input type="hidden" name="exam_id" value="{{$question->exam_id}}">
            <button class="btn btn-info" type="submit" name="action" value="edit">Edit</button>
            <button class="btn btn-danger pull-right" type="submit" name="action" value="delete">Delete</button>
        </form>
    </div>
</div>