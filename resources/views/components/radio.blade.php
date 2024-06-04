<div {{ $attributes->merge(['class' => ''])}}>
    <input type="{{$type}}" name="{{$name}}" class="radio-custom radio" id="radio-{{$id}}" value="{{$id}}" {{($checked)?'checked' : ''}}>
    <label for="radio-{{$id}}" class="radio-custom-label">{{$slot}}</label>
</div>
