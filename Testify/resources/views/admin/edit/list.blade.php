@extends('admin.layouts.app')


@section('content')
    @parent
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p> Choose one of avaible tests to edit</p>
        @foreach($exams as $exam)

                <form action="{{url('admin/editExam')}}" method="post">
                    <div class="input-group">
                        <a href="{{'edit/'.$exam->id}}" class="form-control">{{$exam->name}}</a>
                        <span class="input-group-btn">
                            {{csrf_field()}}
                            <input type="hidden" name="exam_id" value="{{$exam->id}}">

                            <button class="btn btn-danger" type="submit" name="action" value="delete">Delete</button>
                    </span>
                    </div>
                </form>

        @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('admin.includes.create')
        </div>
    </div>
@endsection