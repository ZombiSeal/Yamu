@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Доставка и оплата</h1>
        <section class="advantages">
            <h2>Как сделать заказ?</h2>
            <div class="advantages__list">
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/delivery1.svg')}}" alt="">
                    </div>
                    <p class="advantages__desc ">Выберите блюда и&nbsp;добавьте их&nbsp;в&nbsp;корзину
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/delivery3.svg')}}" alt="">
                    </div>
                    <p class="advantages__desc "> Перейдите в&nbsp;корзину и&nbsp;нажмите кнопку &laquo;Оформить заказ&raquo;
                    </p>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/delivery2.svg')}}" alt="">
                    </div>
                    <p class="advantages__desc ">Заполните данные, выберите способ доставки и&nbsp;оплаты
                    </p>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/delivery4.svg')}}" alt="">
                    </div>
                    <p class="advantages__desc">Подтвердите заказ, нажимая кнопку &laquo;Оформить заказ&raquo;
                    </p>
                </div>
            </div>
        </section>
        <section class="delivery">
            <div class="delivery__row row">
                <div class="delivery__info row__item">
                    <h2>Доставка</h2>
                    <ul class="delivery__list">
                        <li class="delivery__item"><span class="bold">Самовывоз:</span> Заберите свой заказ самостоятельно в&nbsp;нашем ресторане по&nbsp;адресу г.Минск, ул. Сизам, 6 </li>
                        <li class="delivery__item"><span class="bold">Доставка курьером:</span> Доставим ваш заказ в&nbsp;любую точку города Минск в&nbsp;кратчайшие сроки и&nbsp;совершенно бесплатно. </li>
                    </ul>
                    <h2>Оплата</h2>

                    <ul class="delivery__list">
                        <li class="delivery__item"><span class="bold">Наличными:</span> Оплата за&nbsp;заказ производится в&nbsp;белорусских рублях путем передачи наличных денежных средств курьеру </li>
                        <li class="delivery__item"><span class="bold">Банковской картой:</span> Оплата за&nbsp;заказ производится в&nbsp;белорусских рублях посредством банковской пластиковой карты. </li>
                        <li class="delivery__item"><span class="bold">Банковской картой онлыйн:</span> Платежи по банковским картам осуществляются через систему электронных платежей </li>
                    </ul>
                </div>

                <div class="delivery__img row__item">
                    <img src="{{asset('/images/delivery.png')}}" alt="">
                </div>
            </div>
        </section>
    </div>
    <link rel="stylesheet" href="{{asset('/css/about.css')}}">
@endsection
