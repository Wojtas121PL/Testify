@extends('user::layouts.master')


@section('content')
    @parent

    <form method="post" action="{{route('results.progressive.save')}}">
        {{csrf_field()}}
        <input type="hidden" name="exam_id" value="{{$examContent->exam_id}}">
        <input type="hidden" name="answer[{{$examContent->id}}][typeId]" value="{{$examContent->question_type}}">

        <div class="panel">
        <div class="panel-heading text-center">
            <h4>{{$examContent->question_title}}</h4>
        </div>
        <div class="panel-body">
            @if($examContent->question_type == 1)
                @foreach($examContent->answers as $i => $answer )

                    <label class="input-group">
                        <span class="input-group-addon"><input type="radio" name="answer[{{$examContent->id}}][number]" value="{{++$i}}" ></span>
                        <div class="form-control">{{$answer->answer}}</div>
                    </label>
                @endforeach
            @else
                <label class="input-group">
                    <textarea name="answer[{{$examContent->id}}][number]" placeholder="Napisz swoją odpowiedź tutaj..."></textarea>
                </label>
            @endif
        </div>

        <div class="panel-footer clearfix">
            <div class="col-md-6">
                <button class="btn btn-info btn-group-justified">< Wstecz</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-info btn-group-justified" type="submit">Naprzód ></button>

            </div>
        </div>
    </div>
    </form>

@endsection