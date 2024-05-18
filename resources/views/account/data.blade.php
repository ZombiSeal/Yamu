@extends('layouts.account')
@section('info')
    <div class="block">
        <h2>Личные данные</h2>
        <form class="account-form data" action="{{route('account.data.edit')}}" method="post">
            <div class="account-form__block row">
                <div class="account-form__item">
                    <x-input class="validate" name="name" type="text" value="{{auth()->user()->name}}">Имя</x-input>
                    <div class="input-error"></div>
                </div>
                <div class="account-form__item">
                    <x-input class="validate" name="email" type="email" value="{{auth()->user()->email}}">Email
                    </x-input>
                    <div class="input-error"></div>
                </div>
                <div class="account-form__item">
                    <x-input class="validate no-require" name="phone" type="text" value="{{auth()->user()->phone}}">
                        Телефон
                    </x-input>
                    <div class="input-error"></div>
                </div>
                <div class="account-form__item">
                    <x-input name="birthday" type="date" value="{{auth()->user()->birthday}}">Дата рождения</x-input>
                </div>
            </div>
            <x-button class="data-sbmt">Изменить</x-button>
        </form>
    </div>
    <div class="block">
        <h2>Смена пароля</h2>
        <form class="account-form" action="{{route('account.data.password')}}">
            <div class="account-form__block row">
                <div class="account-form__item">
                    <x-input class="validate no-require" name="password" type="password">Новый пароль</x-input>
                    <div class="input-error"></div>
                </div>
                <div class="account-form__item">
                    <x-input class="validate no-require" name="password_repeat" type="password">Повторите пароль
                    </x-input>
                    <div class="input-error"></div>
                </div>
            </div>
            <x-button class="data-sbmt">Изменить</x-button>
        </form>

    </div>
    <script src="{{asset('/js/acc-data.js')}}"></script>
@endsection


