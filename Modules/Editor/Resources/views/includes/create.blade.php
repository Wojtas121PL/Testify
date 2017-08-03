<form action="{{route('exam.store')}}" method="post">
    {{csrf_field()}}
    <div class="input-group">
        <input class="form-control" type="text" name="exam_name" title="Nowy egzamin">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Dodaj</button>
        </span>
    </div>
</form>