@php
    $answers = json_decode($question->answer_list, true);
@endphp
<form action="{{url('/admin/saveQuestion/'.$question->exam_id)}}" method="post">
    {{csrf_field()}}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><input class="form-control" type="text" name="question_title" value="{{$question->question_title}}"></h4>
    </div>

    <div class="panel-body">

            @for($i = 1; $i <= count($answers); $i++)
                <div class="input-group">
                    <span class="input-group-addon">{{$i}}:</span>
                    <input class="form-control" type="text" name="{{'answer'.$i}}" value="{{$answers[$i]}}">
                </div>
            @endfor
        <input class="form-control" type="number" name="answer_correct" value="{{$question->answer_correct}}">

    </div>

    <div class="panel-footer">

            <input type="hidden" name="question_id" value="{{$question->id}}">
            <input type="hidden" name="question_number" value="{{$question->question_number}}">


        <button class="btn btn-info" type="submit" name="action" value="save">Save</button>
            <a class="btn btn-warning" href="{{url('admin/edit/'.$exam->id)}}">Cancel</a>

            <button class="btn btn-danger pull-right" type="submit" name="action" value="delete">Delete</button>
    </div>
</div>
</form>
