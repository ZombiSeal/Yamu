<div {{ $attributes->merge(['class' => 'input'])}}>
    <input id="{{$name}}" class="input__text" type="{{$type}}" name="{{$name}}"
           placeholder=" " {{$attributes}}>
    <label for="{{$name}}" class="input__label">{{$slot}}</label>
</div>
