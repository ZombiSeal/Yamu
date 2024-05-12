@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'btn'])}}>
        <span class="btn__dot"></span>
        <p class="btn__text">{{$slot}}</p>
    </a>
@else
    <div {{ $attributes->merge(['class' => 'btn'])}}>
        <span class="btn__dot"></span>
        <input class="btn__text" type="submit" value="{{$slot}}">
    </div>
@endif
