@extends('layouts.main')
@section('content')
    <div class="account">
        <h1>Личный кабинет</h1>
        <div class="account__container row">
            <nav class="account__menu ac-menu">
                <ul class="ac-menu__list">
                    <li class="ac-menu__item">
                        <a href="{{route('account.data')}}" class="ac-menu__link">Личные данные</a>
                    </li>
                    <li class="ac-menu__item">
                        <a href="{{route('account.orders')}}" class="ac-menu__link">История заказов</a>
                    </li>
                    <li class="ac-menu__item">
                        <a href="{{route('account.reserve')}}" class="ac-menu__link">Бронирование</a>
                    </li>
                    <li class="ac-menu__item">
                        <a href="{{route('account.coupons')}}" class="ac-menu__link">Мои купоны</a>
                    </li>
                    <li class="ac-menu__item">
                        <a href="{{route('logout')}}" class="ac-menu__link">Выйти</a>
                    </li>
                </ul>

            </nav>
            <div class="account__content">
                @yield('info')
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('/css/account.css')}}">
@endsection
