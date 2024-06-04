@if(session("basket"))
<div class="wrapper basket">
    <div class="row basket__row">
        <h1 class="wrapper__title">Корзина</h1>
        <div class="basket__clear">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="/images/svg/clear-basket.svg#clear"></use>
            </svg>
            <a class="clear-basket">Очистить корзину</a>
        </div>
    </div>
    <div class="basket__content">
            @foreach($products as $product)
                <x-basket-card type="basket" :product="$product['product']"></x-basket-card>
            @endforeach
    </div>
</div>
<div class="basket-info">
    <div class="basket-info__wrapper">
        <div class="acent">Сумма заказа: <span class="full-price">{{$fullPrice}} руб.</span ></div>
        <x-button href="{{route('order')}}">Оформить заказ</x-button>
    </div>
</div>
@else
    <x-empty-basket></x-empty-basket>
@endif
<link rel="stylesheet" href="{{asset('/css/basket.css')}}">
<script src="{{asset('/js/catalog.js')}}"></script>

