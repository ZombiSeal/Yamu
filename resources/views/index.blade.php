@extends('layouts.main')
@section('content')
    <div class="banner">
        <video src="/images/video/banner.mp4" loop autoplay></video>
    </div>

    <section class="about">
        <div class="about__wrapper container container--back">
            <div class="about__info">
                <h1 class="about__title">Немного о Yamu</h1>
                <p class="about__text">
                    Добро пожаловать в&nbsp;наш ресторан японской кухни&nbsp;&mdash; оазис традиций и&nbsp;утонченного
                    вкуса. Вдохновленный
                    мастерством японских шеф-поваров, наш ресторан предлагает уникальные блюда, произведенные из&nbsp;свежайших
                    ингредиентов. В&nbsp;нашем меню вы&nbsp;найдете разнообразие суши и&nbsp;роллы, горячий рамен,
                    горячих блюд, а&nbsp;также
                    изысканные десерты и&nbsp;интресеные напитки. Наши интерьеры, выполненные в&nbsp;ярком стиле, где
                    каждая деталь имеет
                    значение.
                </p>
                <x-button class="about__link" href="{{route('about')}}">Узнать больше</x-button>
            </div>
            <div class="about__img">
                <img src="{{asset('/images/main1.png')}}" alt="">
            </div>
        </div>
    </section>

    @isset($products)
        <section class="new">
            <div class="new__wrapper container container--back">
                <h2 class="h1-like new__title">Попробуй новые позиции</h2>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            <div class="swiper-slide">
                                <x-product-card :$product></x-product-card>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endisset

    <section class="contact">
        <div class="container">
            <h2 class="h1-like new__title">Как к нам попасть?</h2>
        </div>
        <div class="contact__wrapper contact-flex">
            <div class="contact-flex__img contact-flex__item">
                <img src="{{asset('/images/main2.jpg')}}" alt="">
            </div>
            <div class="contact-flex__contact contact-flex__item">
                <div class="contact-flex__contact-wrapper">
                    <div class="contact-flex__info">
                        <div class="contact-flex__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="{{asset('/images/svg/icon-phone.svg')}}#svg"></use>
                            </svg>
                        </div>
                        <div class="contact-flex__text">
                            <p class="acent">Телефон</p>
                            <p>+375 29 111 11 11 (А1)</p>
                        </div>
                    </div>
                    <div class="contact-flex__info">
                        <div class="contact-flex__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="{{asset('/images/svg/icon-email.svg')}}#svg"></use>
                            </svg>
                        </div>
                        <div class="contact-flex__text">
                            <p class="acent">Email:</p>
                            <p>infoyamu@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-flex__info">
                        <div class="contact-flex__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="{{asset('/images/svg/icon-address.svg')}}#svg"></use>
                            </svg>
                        </div>
                        <div class="contact-flex__text">
                            <p class="acent">Адрес:</p>
                            <p>г. Минск, ул. Сизам, 6</p>
                        </div>
                    </div>
                    <div class="contact-flex__info">
                        <div class="contact-flex__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="{{asset('/images/svg/icon-time.svg')}}#svg"></use>
                            </svg>
                        </div>
                        <div class="contact-flex__text">
                            <p class="acent">Режим работы:</p>
                            <p>пн-вс : 10:00 - 22:00 </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-flex__map contact-flex__item">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A727e854a556e31e52b5e95ebcd875cfecfd6bc5f7c8b07c924ce48d629a8460a&amp;source=constructor" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('/js/libs/swiper.js')}}"></script>
    <script src="{{asset('/js/catalog.js')}}"></script>

@endsection
