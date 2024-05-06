<div class="wrapper">
    <h1>Регистрация</h1>
    <form class="form" action="{{route('register')}}" method="post">
        <div class="form__item input form__item--no">
            <input id="name" class="form__input input__text" type="text" name="name" placeholder=" ">
            <label for="name" class="form__label input__label">Имя</label>
        </div>
        <div class="form__error">Заполните поле</div>

        <div class="form__item input">
            <input id="email" class="form__input input__text" type="email" name="email" placeholder=" ">
            <label for="email" class="form__label input__label">Email</label>
        </div>

        <div class="form__item input">
            <input id="password" class="form__input input__text" type="password" name="password" placeholder=" ">
            <label for="password" class="form__label input__label">Пароль</label>
        </div>

        <div class="form__item input">
            <input id="password_repeat" class="form__input input__text" type="password" name="password_repeat"
                   placeholder=" ">
            <label for="password_repeat" class="form__label input__label">Повторите пароль</label>
        </div>

        <div class="row form__row">
            <div class="btn btn--m">
                <span class="btn__dot"></span>
                <input class="btn__input form__sbmt" type="submit" value="Зарегистрироваться">
            </div>

            <a href="{{route('r-menu')}}" class="reg-link line" data-page="auth"> Уже есть аккаунт</a>
        </div>

    </form>
</div>


