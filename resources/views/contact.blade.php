@extends('layouts.main')
@section('content')
    <section class="contact">
        <div class="container">
            <h1 class="new__title">Контакты</h1>
        </div>
        <div class="contact__wrapper contact-flex">
            <div class="contact-flex__img contact-flex__item">
                <img src="{{asset('/images/main2.jpg')}}" alt="">
            </div>
            <div class="contact-flex__contact contact-flex__item">
                <div class="contact-flex__contact-wrapper">
                    <div class="contact-flex__info">
                        <div class="contact-flex__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A727e854a556e31e52b5e95ebcd875cfecfd6bc5f7c8b07c924ce48d629a8460a&amp;source=constructor"
                    width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="{{asset('/css/contact.css')}}">
@endsection
