@extends('usermanager::layouts.master')

@section('content')
    @parent
    <div class="panel panel-default">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-body">
            @if(null !==session('done'))
                <div class="alert alert-success">
                    Użytkownik dodany
                </div>
            @endif

            <form action="{{url('/usermanager/addUser')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Nazwa użytkownika:</label>
                    <input type="text" class="form-control" id="name" name="nameUser">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Hasło:</label>
                    <input type="password" class="form-control" id="pwd" name="pwd">
                </div>
                <div class="form-group">
                    <label for="Role">Rola:</label>
                    <select name="role">
                        <option>Administraror</option>
                        <option>Edytor</option>
                        <option>Użytkownik</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Dodaj!</button>
            </form>
        </div>
        <a href="/usermanager/"><button class="btn btn-default">Wróć</button></a>
    </div>
@endsection