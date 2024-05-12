<div class="wrapper">
    <h1>Регистрация</h1>
    <form class="form" action="{{route('register')}}" method="post">
        <div class="form__item">
            <x-input name="name" type="text">Имя*</x-input>
            <div class="input-error"></div>
        </div>

        <div class="form__item">
            <x-input name="email" type="email">Email*</x-input>
            <div class="input-error"></div>
        </div>

        <div class="form__item">
            <x-input name="password" type="password">Пароль*</x-input>
            <div class="input-error"></div>
        </div>

        <div class="form__item">
            <x-input name="password_repeat" type="password">Повторите пароль*</x-input>
            <div class="input-error"></div>
        </div>


        <div class="row form__row">
            <x-button class="btn--m sbmt">Зарегистрироваться</x-button>
            <a href="{{route('r-menu')}}" class="reg-link line" data-page="auth"> Уже есть аккаунт</a>
        </div>

    </form>
</div>

