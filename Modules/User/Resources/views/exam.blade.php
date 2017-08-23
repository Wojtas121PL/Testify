@extends('user::layouts.master')
@section('content')
    @parent
    <script type="text/javascript">
            function startTimer(duration, display) {
                var timer = duration, minutes, seconds;
                setInterval(function () {
                    minutes = parseInt(timer / 60, 10)
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds;

                    if (--timer < 0) {
                        document.getElementById('examForm').submit();
                    }
                }, 1000);
            }

            window.onload = function () {
                $('#timeForExam').hide();
                if (document.getElementById('time').value != 0) {
                    $('#timeForExam').show();
                    var minutes = 60 * document.getElementById('time').value,
                        display = document.querySelector('#timeDisplay');
                    startTimer(minutes, display);
                }
            };
    </script>
    <div id="timeForExam" class="panel panel-body" style="position: fixed; left:0; top:50%;">
            <h4>Czas do zakończenia egzaminu</h4>
            <p id="timeDisplay" class="text-center"></p>
    </div>
        <form id="examForm" method="post" action="{{route('results.save')}}">
            {{csrf_field()}}
            <input type="hidden" name="exam_id" value="{{$examContent->id}}">
            <input type="hidden" name="time" id="time" value="{{$examContent->time}}">
            @if($examContent->xOFy != 0)
                @php($xOFy = 0)
            @endif
        @foreach($examContent->questions as $question)
            @if($examContent->xOFy != 0)
                @if($xOFy++ < $examContent->xOFy)
                    @include('user::question')
                @else

                @endif
            @else
                @include('user::question')
            @endif


        @endforeach

        <button class="btn btn-success" type="submit">Zakończ</button>
        </form>
@endsection