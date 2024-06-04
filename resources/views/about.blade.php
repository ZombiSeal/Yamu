@extends('layouts.main')
@section('content')
    <div class="container">
        <section class="about">
            <div class="about__info">
                <h1 class="about__title">О нас</h1>
                <p class="about__text">13&nbsp;октября 2024 года состоялось торжественное открытие ресторана Yamu по&nbsp;адресу
                    Cизам, 6.
                    Интерьер
                    нового заведения выдержан в&nbsp;ярком, рисованном стиле. Стены, мебель и&nbsp;даже посуда украшены
                    причудливыми, яркими рисунками, создающими атмосферу творчества и&nbsp;вдохновения. Несмотря на&nbsp;необычный
                    дизайн, интерьер остается уютным и&nbsp;располагающим к&nbsp;отдыху.
                </p>
                <p class="about__text">
                    Наша концепция заключается в&nbsp;сочетании традиций японской гастрономии и&nbsp;необычного, яркого
                    окружения. Вы&nbsp;можете попробовать аутентичные суши и&nbsp;роллы, ароматные рамены, сочные
                    такояки и&nbsp;другие
                    любимые блюда.
                    Yamu&nbsp;&mdash; место, где еда становится искусством. Приходите и&nbsp;убедитесь сами!</p>
            </div>
            <div class="about__img">
                <img src="{{asset('/images/about.jpeg')}}" alt="">
            </div>
        </section>
        <section class="advantages">
            <h2 class="h1-like">Наши преимущества</h2>
            <div class="advantages__list">
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/adv1.svg')}}" alt="">
                    </div>
                    <div class="advantages__title acent ">Вкусно и красиво</div>
                    <p class="advantages__desc ">Авторские рецепты блюд и необычная подача
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/adv2.svg')}}" alt="">
                    </div>
                    <div class="advantages__title acent">Приятные цены</div>
                    <p class="advantages__desc "> Мы предлагаем большое количество скидочных купонов
                    </p>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/adv3.svg')}}" alt="">
                    </div>
                    <div class="advantages__title acent">Свежие ингредиенты</div>
                    <p class="advantages__desc ">Используем только свежие и качественные продукты
                    </p>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon">
                        <img src="{{asset('/images/svg/adv4.svg')}}" alt="">
                    </div>
                    <div class="advantages__title acent">Быстрая доставка</div>
                    <p class="advantages__desc">95% заказов мы&nbsp;доставляем в&nbsp;течение 60&nbsp;минут
                    </p>
                </div>
            </div>
        </section>
    </div>
    <link rel="stylesheet" href="{{asset('/css/about.css')}}">
@endsection
