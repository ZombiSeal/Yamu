<x-popup type="alert"></x-popup>
<footer>
    <div class="container footer">
        <div class="logo">
            <a href="{{route('main')}}" class="logo__link">
                <img class="nav__img" src="/images/svg/logo.svg" alt="">
            </a>
        </div>
        <div class="footer__info">
            <div class="acent line">+375 29 111 11 11</div>
            <p>infoyamu@gmail.com</p>
            <p>г. Минск, ул. Сизам, 13</p>
        </div>
        <nav class="footer__nav nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="{{route('about')}}" class="nav__link">О нас</a>
                </li>
                <li class="nav__item">
                    <a href="{{route('booking')}}" class="nav__link">Бронирование</a>
                </li>
                <li class="nav__item">
                    <a href="{{route('delivery')}}" class="nav__link">Доставка и оплата</a>
                </li>
                <li class="nav__item">
                    <a href="{{route('quizzes')}}" class="nav__link">Квизы</a>
                </li>
                <li class="nav__item">
                    <a href="{{route('contact')}}" class="nav__link">Контакты</a>
                </li>
            </ul>
        </nav>
        <div class="footer__social">
            <p class="bold">Наши соцсети:</p>
            <ul class="social-list">
                <li class="contact__list">
                    <a href="" class="contact__item">
                        <img src="/images/svg/icon_youtube.svg" alt="">
                    </a>
                </li>
                <li class="contact__list">
                    <a href="" class="contact__item">
                        <img src="/images/svg/icon_vk.svg" alt="">
                    </a>
                </li>
                <li class="contact__list">
                    <a href="" class="contact__item">
                        <img src="/images/svg/icon_instagram.svg" alt="">
                    </a>
                </li>
            </ul>
            <p class="small">© Kedich Anna 2023. <br>All Rights Reserved</p>
        </div>
    </div>
</footer>
