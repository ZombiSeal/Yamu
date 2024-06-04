<div class="popup" data-type="{{$type}}">
    <div class="popup__wrapper">
        <h2 class="popup__message">Тут будет какой-то текст</h2>
        @if($type === 'alert')
        <x-button class="close">Ок</x-button>
        @else
            <div class="row">
                <x-button class="ok">Да</x-button>
                <x-button class="close">Нет</x-button>
            </div>
        @endif
    </div>
</div>
