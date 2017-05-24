@extends('editor::layouts.master')

@section('content')
    @parent
    @include('admin::includes.displayErrors')

    <div class="panel panel-default">
        <div class="panel-heading">Main info</div>
        <div class="panel-body">
            <form action="{{route('exam.update', $exam->id)}}" method="post">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="new_name" class="form-control" placeholder="{{$exam->name}}">
                    <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="action" value="save">Save</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    @foreach($exam->questions as $question)

        @if($question->id == $edit_id)
            @include('admin::exam.edit.panelEdit')
        @else
            @include('admin::exam.edit.panelDisplay')
        @endif

    @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('admin::exam.edit.addNewQuestion')
        </div>
    </div>
@endsection