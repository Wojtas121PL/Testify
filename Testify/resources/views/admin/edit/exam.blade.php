@extends('admin.layouts.app')


@section('content')
    @parent
        @foreach($examContent as $question)
            @php
            $answers = json_decode($question->answer_list, true);
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>Question number {{$question->question_number}}:</p>
                            <p><strong>{{$question->question_title}}</strong></p>

                            @for($i = 1; $i <= count($answers); $i++)
                                <strong>{{$i}} :</strong>{{$answers[$i]}}<br />
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="nav nav-stacked">
                                <li role="presentation"><a href="#">Edit</a></li>
                                <form action="{{url('/admin/deleteQuestion')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="question_number" value="{{$question->question_number}}">
                                    <input type="hidden" name="exam_id" value="{{$question->exam_id}}">
                                    <li role="presentation"><button class="btn" type="submit">Delete</button></li>
                                </form>
                                <li role="presentation"><a href="#">Messages</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        +
    </button>
    <div class="collapse" id="collapseExample">
        <div class="well">
            @include('admin.includes.addNewQuestion')
        </div>
    </div>
@endsection