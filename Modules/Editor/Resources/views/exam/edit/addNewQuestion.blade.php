
<script>
    window.onload = function () {
        $( "#tabs" ).tabs();
    }

    function appendAnswer(){
        var val = $("#val").val();
        var div = $(
            "<div class='input-group'>" +
            "<span class='input-group-addon'>" +
            "<input type='radio' name='answer_correct' value='"+ val +"'>" +
            "</span>" +
            "<input type='Text' class='form-control' name='answer["+ val +"][answer]'>" +
            "</div>");
        $("#answers").append(div);

        $("#val").val(++val);
    }
    function removeAnswer() {
        var val = $("#val").val();
        $("#answers > .input-group").last().remove();
        $("#val").val(--val);
        if($("#val").val() < 1){
            $("#val").val(1);
        }
    }
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">ABC</a></li>
        <li><a href="#tabs-2">OTWARTE</a></li>
    </ul>

    <div id="tabs-1">
        <input type="hidden" id="val" value="1">
        <form action="{{route('question.store')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="1">
            <div class="form-group">
                <label for="Question">Pytanie</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>
            <div class="form-group" id="answers">
                <label for="Answer">Odpowiedź <small>(kropka sygnalizuje poprawną odpowiedź)</small></label>

            </div>

            <input type="button" class="btn btn-info btn-group-justified" onclick="appendAnswer()" value="Dodaj odpowiedź">
            <input type="button" class="btn btn-info btn-group-justified" onclick="removeAnswer()" value="Usuń odpowiedź">
            <div class="form-group">
                <button class="btn btn-success" type="submit">Dodaj!</button>
            </div>
        </form>
    </div>


    <div id="tabs-2">
        <form action="{{route('question.store.open')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="2">
            <div class="form-group">
                <label for="Question">Pytanie</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>


            <div class="form-group">
                <button class="btn btn-success" type="submit">Dodaj!</button>
            </div>
        </form>
    </div>
</div>

