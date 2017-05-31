@extends('user::layouts.master')


@section('content')
    @parent


    <div class="panel">
        <div class="panel-heading text-center">
            <h3>
                Question
            </h3>
        </div>
        <div class="panel-body">
            <label class="input-group">
                <span class="input-group-addon"><input type="radio" name="answer[][number]" value="" ></span>
                <div class="form-control">xd</div>
            </label>
            <label class="input-group">
                <span class="input-group-addon"><input type="radio" name="answer[][number]" value="" ></span>
                <div class="form-control">xd</div>
            </label>
            <label class="input-group">
                <span class="input-group-addon"><input type="radio" name="answer[][number]" value="" ></span>
                <div class="form-control">xd</div>
            </label>
            <label class="input-group">
                <span class="input-group-addon"><input type="radio" name="answer[][number]" value="" ></span>
                <div class="form-control">xd</div>
            </label>
        </div>

        <div class="panel-footer clearfix">
            <div class="col-md-6">
                <button class="btn btn-info btn-group-justified">< Previous</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-info btn-group-justified">Next ></button>
            </div>
        </div>
    </div>

@endsection