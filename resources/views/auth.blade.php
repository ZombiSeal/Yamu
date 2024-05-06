<div class="wrapper">
    <h1>Авторизация</h1>
    <form class="form" action="{{route('auth')}}" method="post">
        <div class="form__item input form__item--no">
            <input id="email" class="form__input input__text" type="email" name="email" placeholder=" ">
            <label for="email" class="form__label input__label">Email</label>
        </div>
        <div class="form__error">Заполните поле</div>
        <div class="form__item input form__item--no">
            <input id="password" class="form__input input__text" type="password" name="password" placeholder=" ">
            <label for="password" class="form__label input__label">Пароль</label>
        </div>


        <div class="row form__row">
            <div class="btn">
                <span class="btn__dot"></span>
                <input class="btn__input form__sbmt" type="submit" value="Войти">
            </div>
            <a href="{{route('r-menu')}}" class="reg-link line" data-page="register">Зарегистрироваться</a>
        </div>

    </form>
</div>
<script src="{{ asset('/js/auth.js') }}"></script>


