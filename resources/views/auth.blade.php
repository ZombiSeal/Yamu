<div class="wrapper">
    <h1 class="wrapper__title">Авторизация</h1>
    <form class="form" action="{{route('auth')}}" method="post">
        <div class="form__item">
            <x-input name="email" type="email">Email*</x-input>
            <div class="input-error"></div>
        </div>

        <div class="form__item">
            <x-input name="password" type="password">Пароль*</x-input>
            <div class="input-error"></div>
        </div>

        <div class="row form__row">
            <x-button class="sbmt">Войти</x-button>
            <a href="{{route('r-menu')}}" class="reg-link line" data-page="register">Зарегистрироваться</a>
        </div>

    </form>
</div>
<script src="{{ asset('/js/auth.js') }}"></script>


