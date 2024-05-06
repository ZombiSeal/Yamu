<header>
    <div class="container">
        <div class="header-wrapper">
            <div class="logo">
                <a href="{{route('main')}}" class="logo__link">
                    <img class="nav__img" src="/images/svg/logo.svg" alt="">
                </a>
            </div>
            <nav class="nav">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{route('about')}}" class="nav__link {{(request()->is('about')) ? 'active' : ''}}">О нас</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('booking')}}" class="nav__link {{(request()->is('booking')) ? 'active' : ''}}">Бронирование</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('delivery')}}" class="nav__link {{(request()->is('delivery')) ? 'active' : ''}}">Доставка и оплата</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('quizzes')}}" class="nav__link {{(request()->is('quizzes')) ? 'active' : ''}}">Квизы</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('contact')}}" class="nav__link {{(request()->is('contact')) ? 'active' : ''}}">Контакты</a>
                    </li>
                </ul>
            </nav>
            <div class="contact">
                <div class="contact__phone acent line">+375 29 111 11 11</div>
                <ul class="contact__list">
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
            </div>
            <div class="menu-mob">
                <div class="burger">
                    <div class="burger__line burger__line--half burger__line--start"></div>
                    <div class="burger__line burger__line--center"></div>
                    <div class="burger__line burger__line--half burger__line--end"></div>
                </div>

                <div class="curtain__panel curtain__panel--left"></div>
                <nav class="menu-mob__nav nav-mob">
                    <ul class="nav-mob__list">
                        <li class="nav-mob__item">
                            <a href="{{route('about')}}" class="nav-mob__link {{(request()->is('about')) ? 'active' : ''}}">О нас</a>
                        </li>
                        <li class="nav-mob__item">
                            <a href="{{route('booking')}}" class="nav-mob__link {{(request()->is('booking')) ? 'active' : ''}}">Бронирование</a>
                        </li>
                        <li class="nav-mob__item">
                            <a href="{{route('delivery')}}" class="nav-mob__link {{(request()->is('delivery')) ? 'active' : ''}}">Доставка и оплата</a>
                        </li>
                        <li class="nav-mob__item">
                            <a href="{{route('quizzes')}}" class="nav-mob__link {{(request()->is('quizzes')) ? 'active' : ''}}">Квизы</a>
                        </li>
                        <li class="nav-mob__item">
                            <a href="{{route('contact')}}" class="nav-mob__link {{(request()->is('contact')) ? 'active' : ''}}">Контакты</a>
                        </li>
                    </ul>
                </nav>
                <div class="curtain__panel curtain__panel--right"></div>

            </div>
        </div>
    </div>
</header>


