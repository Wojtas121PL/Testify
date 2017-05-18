@extends('user.layouts.app')


@section('content')
    @parent
    <p>
    @if(session('test') == 'end')
        <div class="alert alert-success">
            Test Ended
        </div>
    @endif
        Welcome in the biggest platform for testing people. Choose one of avaible test in menu which you find in left-side web-browser. Good Luck
    </p>
@endsection