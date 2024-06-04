
<div class="quiz__title-up row" data-id="{{$quiz->id}}" data-count="{{$count}}" max-count="{{$questions}}">
    <p class="question__number acent">Вопрос {{$count}}</p>
</div>

<div class="quiz__title">
    <p>{{$question->text}}</p>
</div>

<div class="quiz__answers">
    @foreach($answers as $answer)
        <x-radio class="quiz__radio" type="radio" name="radio" id="{{$answer->id}}">{{$answer->text}}</x-radio>
    @endforeach
</div>

