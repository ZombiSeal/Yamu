<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@800&family=Ubuntu:wght@400;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="{{asset('/js/main.js')}}"></script>
    <title>Yamu</title>
</head>
<body>
<header class="admin-header">
    <div class="logo">
        <a href="{{route('admin')}}" class="logo__link">
            <img class="nav__img" src="/images/svg/logo.svg" alt="">
        </a>
    </div>
</header>
<main>
    <div class="admin-container">
        <nav class="admin-container__menu ac-menu">
            <ul class="ac-menu__list">
                <li class="ac-menu__item {{(request()->is('admin-panel/users')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon_account.svg#icon-acc"></use>
                    </svg>
                    <a href="{{route('admin.users')}}" class="ac-menu__link">Пользователи</a>
                </li>
                <li class="ac-menu__item {{(request()->is('admin-panel/products')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 66 66" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-sushi.svg#svg"></use>
                    </svg>
                    <a href="{{route('admin.products')}}" class="ac-menu__link">Позиции</a>
                </li>
                <li class="ac-menu__item {{(request()->is('admin-panel/orders')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-order-list.svg#icon-order-list"></use>
                    </svg>
                    <a href="{{route('admin.orders')}}" class="ac-menu__link">Заказы</a>
                </li>
                <li class="ac-menu__item {{(request()->is('admin-panel/reserve')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-book.svg#icon-book"></use>
                    </svg>
                    <a href="{{route('admin.reserve')}}" class="ac-menu__link">Бронирование</a>
                </li>
                <li class="ac-menu__item {{(request()->is('admin-panel/coupons')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-coupon.svg#icon-coupon"></use>
                    </svg>
                    <a href="{{route('admin.coupons')}}" class="ac-menu__link">Купоны</a>
                </li>
                <li class="ac-menu__item {{(request()->is('admin-panel/quizzes')) ? 'active' : ''}}">
                    <svg width="40" height="40" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-quiz.svg#icon-quiz"></use>
                    </svg>
                    <a href="{{route('admin.quizzes')}}" class="ac-menu__link">Квизы</a>
                </li>
                <li class="ac-menu__item">
                    <svg width="40" height="40" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="/images/svg/icon-exit.svg#icon-exit"></use>
                    </svg>
                    <a href="{{route('logout')}}" class="ac-menu__link">Выйти</a>
                </li>
            </ul>
        </nav>
        @yield('content')
    </div>
</main>
<x-popup type="confirm"></x-popup>
</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>
<script src="{{asset('/js/libs/flatpicker.js')}}"></script>


<script src="{{asset('/js/libs/input-mask.js')}}"></script>
<script src="{{asset('/js/admin.js')}}"></script>
<link rel="stylesheet" href="{{asset('/css/admin.css')}}">



</html>
