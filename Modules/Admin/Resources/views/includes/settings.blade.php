{{--Czas egzaminu--}}
@if($Settings[0]->time != 0)
    <div class="form-group">
        <label for="time">Czas na rozwiązanie testu w min: </label>
        <input type="number" class="form-control" min="0" value="{{$Settings[0]->time}}" name="time" id="time" placeholder="Czas na rozwiązanie egzaminu">
    </div>
@else
    <div class="form-group">
        <label for="time"> Czas na rozwiązanie testu w min: </label>
        <input type="number" class="form-control" min="0" name="time" id="time" placeholder="Czas na rozwiązanie egzaminu">
    </div>
@endif


{{--Ilosc pytan--}}
@if($Settings[0]->xOFy != null)
    <div class="form-group">
        <label for="xOFy">Ilosc pytań na egzaminie: </label>
        <input type="number" class="form-control" min="0" name="xOFy" id="xOFy" value="{{$Settings[0]->xOFy}}" placeholder="Ilośc pytań">
    </div>
@else
    <div class="form-group">
        <label for="xOFy">Ilosc pytań na egzaminie: </label>
        <input type="number" class="form-control" min="0" name="xOFy" id="xOFy" placeholder="Ilośc pytań">
    </div>
@endif


{{--Losowanie pytań--}}
@if($Settings[0]->random == true)
    <label class="checkbox-inline">
        <input type="checkbox" name="random" id="random" value="1" disabled checked>Losowa kolejność pytań
        <input type="hidden" name="set_random" value="1">
    </label>
@else
    <label class="checkbox-inline">
        <input type="checkbox" name="random" id="random" value="0" disabled>Losowa kolejność pytań
        <input type="hidden" name="set_random" value="0">
    </label>
@endif


{{--Progresywny egzamin--}}
@if($Settings[0]->progressive == true)
    <label class="checkbox-inline">
        <input type="checkbox" name="progressive" id="progressive" value="1" disabled checked>Egzamin progresywny
        <input type="hidden" name="set_progressive" value="1">
    </label>
@else
    <label class="checkbox-inline">
        <input type="checkbox" name="progressive" id="progressive" value="0" disabled>Egzamin progresywny
        <input type="hidden" name="set_progressive" value="0">
    </label>
@endif


{{--Strona z Zasadami--}}
@if($Settings[0]->rules_page == 1)
    <label class="checkbox-inline">
        <input type="checkbox" name="rules_page" value="1" checked>Strona z zasadami
        <input type="hidden" name="set_rules" value="1">
    </label>
    <textarea name="rules" placeholder="Wpisz tutaj zasady testu..">{{$Settings[0]->rules_page_text}}</textarea>
@else
    <label class="checkbox-inline">
        <input type="checkbox" name="rules_page" value="0">Strona z zasadami
        <input type="hidden" name="set_rules" value="0">
    </label>
    <textarea class="form-control" name="rules" placeholder="Wpisz tutaj zasady testu.."></textarea>
@endif