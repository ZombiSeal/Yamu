@extends('layouts.main')
@section('content')
    @php
        $valueName = $valuePhone = "";
        if(auth()->check()) {
            $valueName = auth()->user()->name;
            $valuePhone = auth()->user()->phone;
        }
    @endphp
    <div class="container">
        <h1>Оформление заказа</h1>
        <div class="order row">
            <div class="order__data">
                <div class="order__warning acent acent--s">!!! Минимальная сумма заказа 23 руб.</div>
                <form class="order__form" action="{{route('order.add')}}">
                    @if(!$additions->isEmpty())
                        <div class="order__sect">
                            <h2>Приборы</h2>
                            <div class="row addition">
                                @foreach($additions as $addition)
                                    <div class="addition__item" data-id="{{$addition->id}}">
                                        <div class="addition__title">{{$addition->title}}</div>
                                        <x-number class="number-addition" value="0"></x-number>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(!$deliveries->isEmpty())
                        <div class="order__sect">
                            <h2>Доставка</h2>
                            <div class="row tabs" data-sect="delivery">
                                @foreach($deliveries as $key => $delivery)
                                    <div class="tabs__item {{($key === 0) ? 'active' : ''}}"
                                         data-tab="{{$delivery->code}}"
                                         data-id="{{$delivery->id}}"
                                    >
                                        {{$delivery->title}}
                                    </div>
                                @endforeach
                            </div>

                            <div class="order__address tab-content show" data-tab="courier" data-sect="delivery">
                                <x-input class="validate no-text"
                                         name="city"
                                         type="text"
                                         placeholder="{{$address->city}}"
                                         value="{{$address->city}}"
                                         readonly
                                >Город*</x-input>

                                <x-input class="validate no-text" name="street" type="text">Улица*</x-input>
                                <x-input class="validate number no-text" name="house" type="text">Дом*</x-input>
                                <x-input name="corpus" type="text">Корпус</x-input>
                                <x-input class="validate no-require number no-text" name="flat" type="text">Квартира</x-input>
                                <x-input class="validate no-require number no-text" name="entrance" type="text">Подъезд</x-input>
                                <x-input class="validate no-require number no-text" name="floor" type="text">Этаж</x-input>
                            </div>
                            <div class="tab-content" data-tab="selfservice" data-sect="delivery">
                                <div class="tab-content__text">Вы сможете забрать заказ по адресу: г. {{$address->city}}
                                    , ул.
                                    {{$address->street}}, {{$address->house}}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="order__sect">
                        <h2>Время доставки</h2>
                        <div class="row tabs" data-sect="time">
                            <div class="tabs__item active" data-tab="fast">
                                Как можно скорее
                            </div>
                            <div class="tabs__item" data-tab="time">
                                В определенное время
                            </div>
                        </div>

                        <div class="tab-content show" data-tab="fast" data-sect="time">
                            <div class="tab-content__text">Ваш заказ будет готов через час после оформления заказа</div>
                        </div>
                        <div class="tab-content tab-content--time" data-tab="time" data-sect="time">

                            <p>Выбрать время:</p>
                            <x-input name="time" type="time"></x-input>

                        </div>
                    </div>

                    @if(!$payments->isEmpty())
                        <div class="order__sect">
                            <h2>Способ оплаты</h2>
                            <div class="row payment">
                                @foreach($payments as $key=>$payment)
                                    <div class="payment__item {{($key === 0) ? 'active' : ''}}"
                                         data-id="{{$payment->id}}">
                                        {{$payment->title}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="order__sect">
                        <h2>Ваши данные</h2>
                        <div class="row personal">
                            <x-input class="validate personal__item no-text" name="name" type="text" value="{{$valueName}}">Имя*</x-input>
                            <x-input class="validate personal__item no-text" name="phone" type="text" value="{{$valuePhone}}">Телефон*</x-input>
                        </div>
                    </div>
                    <div class="order__sect">
                        <h2>Комментарий к заказу</h2>
                        <div class="input input--area">
                        <textarea id="comment" class="input__text" name="comment"
                                  placeholder=" "></textarea>
                            <label for="comment" class="input__label">Комментарий</label>
                        </div>
                    </div>
                    <div class="order__sbmt">
                        <x-button class="smbt">Оформить заказ</x-button>
                        <div class="order__warning"><span
                                    class="acent acent--s">!!! Минимальная сумма заказа 23 руб.</span></div>
                    </div>
                </form>
            </div>
            <div class="order__info">
                <div class="order__block">
                    <h2>Ваш заказ</h2>
                    <div class="order__list">
                        @foreach($products as $product)
                            <x-basket-card type="order" :product="$product['product']"></x-basket-card>
                        @endforeach
                    </div>
                    <div class="order__price acent acent--s row">
                        <p>Сумма заказа:</p>
                        <p class="full-price">{{$fullPrice}} руб.</p>
                    </div>
                    <div class="order__price acent acent--s row">
                        <p>Всего к оплате:</p>
                        <p class="coupon-price">{{$fullPrice}} руб.</p>
                    </div>

                </div>
                <div class="order__coupon row">
                    <x-input class="input-coupon" name="coupon" type="text">Купон</x-input>
                    <x-button class="coupon-btn">Применить</x-button>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('/css/order.css')}}">
    <script src="{{asset('/js/catalog.js')}}"></script>
@endsection
