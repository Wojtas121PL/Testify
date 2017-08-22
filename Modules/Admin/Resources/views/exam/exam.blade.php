@extends('admin::layouts.master')

@section('content')
    @parent
    <script type="text/javascript">
        function  scrollDown() {
            $('html,body').animate(
                {scrollTop: $('#collapseExample').offset().top}
            )
        }
    </script>
    @include('admin::includes.displayErrors')
    @if(null != session('add'))
        @if(session('add') != 0)
            <div class="alert alert-success">Użytkownicy od teraz mają zezwolenie na rozwiązanie egzaminu</div>
            @elseif(session('add') == 0)
            <div class="alert alert-warning">Brak zmian</div>
        @endif
    @endif
    <form class="panel panel-default">
        <div class="panel-heading">Widok egzaminu</div>
        <div class="panel-body">
            <form action="{{route('exam.update', $exam->id)}}" method="post">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="new_name" class="form-control" placeholder="{{$exam->name}}">
                    <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="action" value="save">Zapisz</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="table-bordered">
            <form action="{{route('exam.save.settings', $exam->id)}}" method="post" class="panel panel-default">
                {{csrf_field()}}
                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                @if($Settings[0]->time != null)
                    <div class="panel-body">
                        Czas na rozwiązanie testu w min
                        <input type="number" min="0" value="{{$Settings[0]->time}}" name="time" placeholder="Czas na rozwiązanie egzaminu">
                    </div>
                @else
                    <div class="panel-body">
                        Czas na rozwiązanie testu w min
                        <input type="number" min="0" name="time" placeholder="Czas na rozwiązanie egzaminu">
                    </div>
                @endif

                @if($Settings[0]->xOFy != null)
                    <div class="panel-body">
                        Ilosc pytań na egzaminie <input type="number" min="0" name="xOFy" value="{{$Settings[0]->xOFy}}" placeholder="Ilośc pytań">
                    </div>
                @else
                    <div class="panel-body">
                        Ilosc pytań na egzaminie <input type="number" min="0" name="xOFy" placeholder="Ilośc pytań">
                    </div>
                @endif

                @if($Settings[0]->random == true)
                    <div class="panel-body">
                        Losowa kolejność pytań<input type="checkbox" name="random" value="1" checked>
                        <input type="hidden" name="set_random" value="1">
                    </div>
                @else
                    <div class="panel-body">
                        Losowa kolejność pytań<input type="checkbox" name="random" value="0">
                        <input type="hidden" name="set_random" value="0">
                    </div>
                @endif

                @if($Settings[0]->progressive == true)
                    <div class="panel-body">
                        Egzamin progresywny <input type="checkbox" name="progressive" value="1" checked>
                        <input type="hidden" name="set_progressive" value="1">
                    </div>
                @else
                    <div class="panel-body">
                        Egzamin progresywny <input type="checkbox" name="progressive" value="0">
                        <input type="hidden" name="set_progressive" value="0">
                    </div>
                @endif

                @if($Settings[0]->rules_page == true)
                    <div class="panel-body">
                        Strona z zasadami <input type="checkbox" name="rules_page" value="1" checked>
                        <input type="hidden" name="set_rules" value="1">
                        <textarea name="rules" placeholder="Wpisz tutaj zasady testu.."></textarea>
                    </div>
                @else
                    <div class="panel-body">
                        Strona z zasadami <input type="checkbox" name="rules_page" value="0">
                        <input type="hidden" name="set_rules" value="0">
                        <textarea name="rules" placeholder="Wpisz tutaj zasady testu.."></textarea>
                    </div>
                @endif
<div class="panel-body">
    <button class="btn btn-success" type="submit">Zapisz ustawienia</button>
</div>

            </form>
        </div>
        @isset($Users)
        <div class="well">Wybierz użytkowników którzy mają prawo wykonać test
            <form method="post" action="{{route('saveUsers.exam')}}">
            <div class="table-bordered">
                    {{csrf_field()}}
                    <input type="hidden" name="testName" value="{{$exam->id}}">
                    <div>
                        @foreach($Users as $i => $user)
                            @if($user->role == 3)
                                    @if($user->status == "belong")

                                        <input type="checkbox" name="user[{{$user->id}}][check]" checked>{{$user->name}}
                                        <input type="hidden" name="user[{{$user->id}}][set]" value="1">
                                    @else
                                        <input type="checkbox" name="user[{{$user->id}}][check]" >{{$user->name}}
                                    <input type="hidden" name="user[{{$user->id}}][set]" value="0">
                                    @endif
                            @endif
                        @endforeach
                    </div>
            </div>
                <div class="table-bordered">
                    <label>Wybierz grupy które mają prawo wykonać test</label><br />
                    @foreach($Groups as $group)
                        @if($group->groupStatus == "belong")
                            <input type="checkbox" name="group[{{$group->id}}][check]" checked>{{$group->group_name}}
                            <input type="hidden" name="group[{{$group->id}}][set]" value="1">
                        @else
                            <input type="checkbox" name="group[{{$group->id}}][check]" >{{$group->group_name}}
                            <input type="hidden" name="group[{{$group->id}}][set]" value="0">
                        @endif
                    @endforeach
                </div>
                <button type="submit" class="btn-success">Zapisz</button>
    </form>
    </div>
        @endisset
    @foreach($exam->questions as $question)
        @if($question->id == $edit_id)
            @include('admin::exam.edit.panelEdit')
        @else
            @include('admin::exam.edit.panelDisplay')
        @endif

    @endforeach
    <button class="btn btn-primary btn-group-justified" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="scrollDown()">
        +
    </button>
    <div class="collapse" id="collapseExample">
        @include('admin::exam.edit.addNewQuestion')
    </div>
@endsection