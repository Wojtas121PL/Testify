@extends('admin.layouts.app')


@section('content')
    @parent
    @include('includes.displayErrors')

    <div class="panel panel-default">
        <div class="panel-heading">Main info</div>
        <div class="panel-body">
            <form action="{{url('admin/editExam')}}" method="post">
                <div class="input-group">
                    <input type="text" name="new_name" class="form-control" placeholder="{{$exam->name}}">
                    <span class="input-group-btn">
                            {{csrf_field()}}
                        <input type="hidden" name="exam_id" value="{{$exam->id}}">
                            <button class="btn btn-info" type="submit" name="action" value="save">Save</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    @foreach($exam->questions as $question)

        @if($question->id == $question_id)
            @include('admin.edit.exam.panelEdit')
        @else
            @include('admin.edit.exam.panelDisplay')
        @endif

    @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('admin.edit.exam.addNewQuestion')
        </div>
    </div>
@endsection