@extends('usermanager::layouts.master')
<script type="text/javascript">
    function showGroup(role) {
        console.log("Dziala");
        if(role == "Użytkownik"){
            $('.groups').show();
        }
        else {
            $('.groups').hide();
        }
    }
</script>
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
            @if(null != session('done'))
                @if(session('done') == 'yes')
                    <div class="alert alert-success">Użytkownik dodany</div>
                    @elseif(session('done') == 'existEmail')
                        <div class="alert alert-danger">Istnieje już użytkownik o takim adresie email</div>
                    @endif
            @endif
            @if(null != session('root'))
                @if(session('root') == 'try')
                    <div class="alert alert-danger">Próbujesz dezaktywować konto głównego administratora. Akcja zabroniona</div>
                @endif
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
                    <select name="role" onchange="showGroup(this.value)">
                        <option>Administrator</option>
                        <option>Edytor</option>
                        <option>Użytkownik</option>
                    </select>
                </div>
                <div class="form-group groups" style="display: none;">
                    <label>Wybierz do jakich grup należeć będzie użytkownik</label><br />
                    @foreach($groups as $group)
                        <input type="checkbox" name="group[{{$group->id}}][check]" >{{$group->group_name}}
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-1"><input type="submit" class="btn btn-success" value="Dodaj!"/></div>
                    <div class="col-md-1"><a href="/usermanager/"><button type="button" class="btn btn-danger">Wróć</button></a></div>
                </div>
            </form>
        </div>
    </div>
@endsection