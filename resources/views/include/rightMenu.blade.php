<div class="r-menu-wrapper">
    <div class="r-menu-wrapper__menu r-menu">
        <nav class="r-menu__nav">
            <ul class="r-menu__list">
                <li class="r-menu__item content-link">
                    <a href="{{route('r-menu')}}" class="r-menu__link" data-page="basket">
                        <div class="capacity {{(session('fullCapacity')) ? "show" : ""}}">{{(session('fullCapacity')) ?: ""}}</div>
                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-shop.svg#shop"></use>
                        </svg>
                    </a>
                </li>
                <li class="r-menu__item content-link">
                    <a href="{{route('r-menu')}}" class="r-menu__link" data-page="menu">
                        <img src="/images/svg/icon_menu.svg" alt="">
                    </a>
                </li>
                <li class="r-menu__item @guest content-link @endguest">
                    <a href="@guest {{route('r-menu')}} @else {{route('account')}}  @endguest"
                       class="r-menu__link"
                       data-page="auth">
                        <img src="/images/svg/icon_account.svg" alt="">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="r-menu-wrapper__content">
    </div>
</div>

<script src="{{ asset('/js/r-menu.js') }}"></script>

