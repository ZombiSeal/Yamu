@extends('layouts.main')
@section('content')
<div class="container">
    <h1>Оформление заказа</h1>
    <div class="order row">
        <div class="order__data">
            <div class="order__warning acent acent--s">!!! Минимальная сумма заказа 23 руб.</div>
            <form class="order__form ">
                <div class="order__sect">
                    <h2>Приборы</h2>
                    <div class="row attention">
                        <div class="attention__item">
                            <div class="attention__title">Палочки</div>
                            <x-number></x-number>
                        </div>
                        <div class="attention__item">
                            <div class="attention__title">Вилка</div>
                            <x-number></x-number>
                        </div>
                        <div class="attention__item">
                            <div class="attention__title">Ложка</div>
                            <x-number></x-number>
                        </div>
                    </div>
                </div>
                <div class="order__sect">
                    <h2>Доставка</h2>
                    <div class="row tabs " data-sect="delivery">
                        <div class="tabs__item active" data-tab="courier">
                            Доставка курьером
                        </div>
                        <div class="tabs__item" data-tab="selfservice">
                            Самовывоз
                        </div>
                    </div>

                    <div class="order__address tab-content show" data-tab="courier" data-sect="delivery">
                        <div class="input">
                            <input id="city" class="input__text" type="text" name="city"
                                   placeholder="Минск" value="Минск" readonly>
                            <label for="city" class="input__label">Город</label>
                        </div>
                        <div class="input">
                            <input id="street" class="input__text" type="text" name="street"
                                   placeholder=" ">
                            <label for="street" class="input__label">Улица</label>
                        </div>
                        <div class="input">
                            <input id="house" class="input__text" type="text" name="house"
                                   placeholder=" ">
                            <label for="house" class="input__label">Дом</label>
                        </div>
                        <div class="input">
                            <input id="corpus" class="input__text" type="text" name="corpus"
                                   placeholder=" ">
                            <label for="corpus" class="input__label">Корпус</label>
                        </div>
                        <div class="input">
                            <input id="flat" class="input__text" type="text" name="flat"
                                   placeholder=" ">
                            <label for="flat" class="input__label">Квартира</label>
                        </div>
                        <div class="input">
                            <input id="entrance" class="input__text" type="text" name="entrance"
                                   placeholder=" ">
                            <label for="entrance" class="input__label">Подъезд</label>
                        </div>
                        <div class="input">
                            <input id="floor" class="input__text" type="text" name="floor"
                                   placeholder=" ">
                            <label for="floor" class="input__label">Этаж</label>
                        </div>
                    </div>
                    <div class="tab-content" data-tab="selfservice" data-sect="delivery">
                       <div class="tab-content__text">Вы сможете забрать заказ по адресу: г. Минск, ул. Сизам, 6</div>
                    </div>
                </div>

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
                        <div class="input">
                            <input id="time" class="input__text" type="time" name="time"
                                   placeholder="10:00">
                        </div>
                    </div>
                </div>

                <div class="order__sect">
                    <h2>Способ оплаты</h2>
                    <div class="row payment">
                        <div class="payment__item active" data-id="1">
                            Наличные
                        </div>
                        <div class="payment__item" data-id="2">
                            Банковская карта
                        </div>
                        <div class="payment__item" data-id="3">
                            Online оплата картой
                        </div>
                    </div>
                </div>

                <div class="order__sect">
                    <h2>Ваши данные</h2>
                    <div class="row personal">
                        <div class="input personal__item">
                            <input id="name" class="input__text" type="text" name="name"
                                   placeholder=" ">
                            <label for="city" class="input__label">Имя</label>
                        </div>
                        <div class="input personal__item">
                            <input id="phone" class="input__text" type="text" name="phone"
                                   placeholder=" ">
                            <label for="phone" class="input__label">Телефон</label>
                        </div>
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
                    <x-button>Оформить заказ</x-button>
                    <div class="order__warning"><span class="acent acent--s">!!! Минимальная сумма заказа 23 руб.</span></div>
                </div>
            </form>
        </div>
        <div class="order__info">
            <div class="order__block">
                <h2>Ваш заказ</h2>
                <div class="order__list">
                    <x-basket-card type="order"></x-basket-card>
                    <x-basket-card type="order"></x-basket-card>
                    <x-basket-card type="order"></x-basket-card>
                    <x-basket-card type="order"></x-basket-card>
                    <x-basket-card type="order"></x-basket-card>
                    <x-basket-card type="order"></x-basket-card>
                </div>
                <div class="order__price acent acent--s row">
                    <p>Сумма заказа:</p>
                    <p>40.00 руб.</p>
                </div>
                <div class="order__price acent acent--s row">
                    <p>Всего к оплате:</p>
                    <p>40.00 руб.</p>
                </div>
                <div class="coupon">
                    <div class="coupon__info">
                        <p class="coupon__code acent acent--s">code123</p>
                    </div>
                    <button class="coupon__del">
                        <svg class="icon icon--l" width="25" height="25" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-close.svg#close"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="order__coupon row">
                <div class="input">
                    <input id="coupon" class="input__text" type="text" name="coupon"
                           placeholder=" ">
                    <label for="coupon" class="input__label">Купон</label>
                </div>
                <x-button>Применить</x-button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{asset('/css/order.css')}}">
<script src="{{asset('/js/catalog.js')}}"></script>
@endsection
