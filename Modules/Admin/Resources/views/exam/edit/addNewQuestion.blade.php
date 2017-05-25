
<script>
    window.onload = function () {
        $( "#tabs" ).tabs();
    }
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">ABC</a></li>
        <li><a href="#tabs-2">OPEN</a></li>
    </ul>

    <div id="tabs-1">
        <form action="{{route('question.store')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="1">
            <div class="form-group">
                <label for="Question">Title</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>
            <div class="form-group">
                <label for="Answer">Answers <small>(dots on the left specify correct answer)</small></label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="answer_correct" value="1">
                    </span>
                    <input type="Text" class="form-control" id="answer1" name="answer1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="answer_correct" value="2">
                    </span>
                    <input type="Text" class="form-control" id="answer2" name="answer2">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="answer_correct" value="3">
                    </span>
                    <input type="Text" class="form-control" id="answer3" name="answer3">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="answer_correct" value="4">
                    </span>
                    <input type="Text" class="form-control" id="answer4" name="answer4">
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Add!</button>
            </div>
        </form>
    </div>


    <div id="tabs-2">
        <form action="{{route('question.store')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <input type="hidden" name="question_type" value="2">
            <div class="form-group">
                <label for="Question">Title</label>
                <input type="text" class="form-control" id="Question" name="question_title">
            </div>


            <div class="form-group">
                <button class="btn btn-success" type="submit">Add!</button>
            </div>
        </form>
    </div>
</div>