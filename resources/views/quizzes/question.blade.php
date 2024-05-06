<div class="quiz__title-up row" data-id="{{$quiz->id}}" data-count="{{$count}}" max-count="{{$questions}}">
    <p class="question__number acent">Вопрос {{$count}}</p>
    <p class="acent">{{$count}}/{{$questions}}</p>
</div>

<div class="quiz__title">
    <p>{{$question->text}}</p>
</div>

<div class="quiz__answers">
    @foreach($answers as $answer)
        <input class="radio" type="radio" name="answer" value="{{$answer->id}}"> {{$answer->text}}
    @endforeach
</div>

