<form action="{{url('admin/addExam')}}" method="post">
    {{csrf_field()}}
    <div class="input-group">
        <input class="form-control" type="text" name="exam_name" title="New exam">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Add</button>
        </span>
    </div>
</form>