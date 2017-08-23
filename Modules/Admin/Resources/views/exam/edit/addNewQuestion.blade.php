<script>
    window.onload = function () {
        $("#tabs").tabs();
    }

    function appendAnswerWithRadioButton() {
        var val = $("#valABC").val();
        var div = $(
            "<div class='input-group'>" +
            "<span class='input-group-addon'>" +
            "<input type='radio' name='answer_correct' value='" + val + "'>" +
            "</span>" +
            "<input type='Text' class='form-control' name='answer[" + val + "][answer]'>" +
            "</div>");
        $("#answersABC").append(div);

        $("#valABC").val(++val);
    }

    function appendAnswerWithCheckBox() {
        var val = $("#valMultipleCheck").val();
        var div = $(
            "<div class='input-group'>" +
            "<span class='input-group-addon'>" +
            "<input type='checkbox' name='answer_correct[" + val + "][check]' value='" + val + "'>" +
            "</span>" +
            "<input type='Text' class='form-control' name='answer[" + val + "][answer]'>" +
            "</div>");
        $("#answersMultipleCheck").append(div);

        $("#valMultipleCheck").val(++val);
    }

    function removeAnswerFromABC() {
        var val = $("#valABC").val();
        $("#answersABC > .input-group").last().remove();
        $("#valABC").val(--val);
        if ($("#valABC").val() < 1) {
            $("#valABC").val(1);
        }
    }

    function removeAnswerFromMultipleCheck() {
        var val = $("#valMultipleCheck").val();
        $("#answersMultipleCheck > .input-group").last().remove();
        $("#valMultipleCheck").val(--val);
        if ($("#valMultipleCheck").val() < 1) {
            $("#valMultipleCheck").val(1);
        }
    }
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">ABC</a></li>
        <li><a href="#tabs-2">WIELOKROTNEGO WYBORU</a></li>
        <li><a href="#tabs-3">OTWARTE</a></li>
    </ul>

    <div id="tabs-1">
        <input type="hidden" id="valABC" value="1">
        <form action="{{route('question.store')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="1">
            <div class="form-group">
                <label for="Question">Pytanie</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>
            <div class="form-group" id="answersABC">
                <label for="Answer">Odpowiedź
                    <small>(kropka sygnalizuje poprawną odpowiedź)</small>
                </label>

            </div>

            <input type="button" class="btn btn-info btn-group-justified" onclick="appendAnswerWithRadioButton()"
                   value="Dodaj odpowiedź">
            <input type="button" class="btn btn-info btn-group-justified" onclick="removeAnswerFromABC()"
                   value="Usuń odpowiedź">
            <div class="form-group">
                <button class="btn btn-success" type="submit">Dodaj!</button>
            </div>
        </form>
    </div>

    <div id="tabs-2">
        <input type="hidden" id="valMultipleCheck" value="1">
        <form action="{{route('question.store.multiCheck')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="3">
            <div class="form-group">
                <label for="Question">Pytanie</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>
            <div class="form-group" id="answersMultipleCheck">
                <label for="Answer">Odpowiedź
                    <small>(krzyżyk sygnalizuje poprawną odpowiedź)</small>
                </label>

            </div>

            <input type="button" class="btn btn-info btn-group-justified" onclick="appendAnswerWithCheckBox()"
                   value="Dodaj odpowiedź">
            <input type="button" class="btn btn-info btn-group-justified" onclick="removeAnswerFromMultipleCheck()"
                   value="Usuń odpowiedź">
            <div class="form-group">
                <button class="btn btn-success" type="submit">Dodaj!</button>
            </div>
        </form>
    </div>

    <div id="tabs-3">
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

