@extends('admin.layouts.app')


@section('content')
    @parent
    <p> Choose one of avaible test</p>
    <ul class="nav nav-pills nav-stacked">
        @foreach($exams as $exam)
            <li role="presentation">
                <div class="input-group input-group-md">
                    <a class="" href="{{'edit/'.$exam->id}}">{{$exam->name}}</a>
                      <span class="input-group-btn">
                          <form action="{{url('admin/deleteExam')}}" method="post">
                              {{csrf_field()}}
                              <input type="hidden" name="exam_id" value="{{$exam->id}}">
                              <button class="btn btn-default" type="submit">Del</button>
                          </form>
                      </span>
                </div>
            </li>
        @endforeach
    </ul>
    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('admin.includes.create')
        </div>
    </div>
@endsection