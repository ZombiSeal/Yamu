@extends('layouts.main')
@section('content')
    <div class="account container">
        <h1>Личный кабинет</h1>
        <div class="account__container row">
            <nav class="account__menu ac-menu">
                <ul class="ac-menu__list">
                    <li class="ac-menu__item {{(request()->is('account/data')) ? 'active' : ''}}">
                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                        </svg>
                        <a href="{{route('account.data')}}" class="ac-menu__link">Личные данные</a>
                    </li>
                    <li class="ac-menu__item {{(request()->is('account/orders')) ? 'active' : ''}}">
                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-order-list.svg#icon-order-list"></use>
                        </svg>
                        <a href="{{route('account.orders')}}" class="ac-menu__link">История заказов</a>
                    </li>
                    <li class="ac-menu__item {{(request()->is('account/reserve')) ? 'active' : ''}}">
                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-book.svg#icon-book"></use>
                        </svg>
                        <a href="{{route('account.reserve')}}" class="ac-menu__link">Бронирование</a>
                    </li>
                    <li class="ac-menu__item {{(request()->is('account/coupons')) ? 'active' : ''}}">
                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-coupon.svg#icon-coupon"></use>
                        </svg>
                        <a href="{{route('account.coupons')}}" class="ac-menu__link">Мои купоны</a>
                    </li>
                    <li class="ac-menu__item">
                        <svg width="50" height="50" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-exit.svg#icon-exit"></use>
                        </svg>
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
    <script src="{{asset('/js/account.js')}}"></script>
@endsection
