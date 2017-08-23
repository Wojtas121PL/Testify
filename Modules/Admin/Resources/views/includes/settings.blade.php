{{--Czas egzaminu--}}
@if($Settings[0]->time != 0)
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


{{--Ilosc pytan--}}
@if($Settings[0]->xOFy != null)
    <div class="panel-body">
        Ilosc pytań na egzaminie <input type="number" min="0" name="xOFy" value="{{$Settings[0]->xOFy}}" placeholder="Ilośc pytań">
    </div>
@else
    <div class="panel-body">
        Ilosc pytań na egzaminie <input type="number" min="0" name="xOFy" placeholder="Ilośc pytań">
    </div>
@endif


{{--Losowanie pytań--}}
@if($Settings[0]->random == true)
    <div class="panel-body">
        Losowa kolejność pytań<input type="checkbox" name="random" value="1" disabled checked>
        <input type="hidden" name="set_random" value="1">
    </div>
@else
    <div class="panel-body">
        Losowa kolejność pytań<input type="checkbox" name="random" value="0" disabled>
        <input type="hidden" name="set_random" value="0">
    </div>
@endif


{{--Progresywny egzamin--}}
@if($Settings[0]->progressive == true)
    <div class="panel-body">
        Egzamin progresywny <input type="checkbox" name="progressive" value="1" disabled checked>
        <input type="hidden" name="set_progressive" value="1">
    </div>
@else
    <div class="panel-body">
        Egzamin progresywny <input type="checkbox" name="progressive" value="0" disabled>
        <input type="hidden" name="set_progressive" value="0">
    </div>
@endif


{{--Strona z Zasadami--}}
@if($Settings[0]->rules_page == 1)
    <div class="panel-body">
        Strona z zasadami <input type="checkbox" name="rules_page" value="1" checked>
        <input type="hidden" name="set_rules" value="1">
        <textarea name="rules" placeholder="Wpisz tutaj zasady testu..">{{$Settings[0]->rules_page_text}}</textarea>
    </div>
@else
    <div class="panel-body">
        Strona z zasadami <input type="checkbox" name="rules_page" value="0">
        <input type="hidden" name="set_rules" value="0">
        <textarea name="rules" placeholder="Wpisz tutaj zasady testu.."></textarea>
    </div>
@endif