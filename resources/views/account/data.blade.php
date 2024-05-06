@extends('layouts.account')
@section('info')
    <h2>Личные данные</h2>
    <div class="error-data"></div>
    <form class="form data" action="{{route('account.data.edit')}}" method="post">
        <div class="block row">
            <input type="text" class="input-text" name="name" placeholder="Имя" value="{{auth()->user()->name}}">
            <input type="text" class="input-text" name="lastname" placeholder="Фамилия" value="{{auth()->user()->lastname}}">
            <input type="date" class="input-text" name="birthday" placeholder="Дата рождения" value="{{auth()->user()->birthday}}">
            <input type="email" class="input-text" name="email" placeholder="Email" value="{{auth()->user()->email}}">
            <input type="text" class="input-text" name="phone" placeholder="Телефон" value="{{auth()->user()->phone}}">
        </div>
        <input type="submit" class="btn data-sbmt" value="Изменить">
    </form>
    <h2>Смена пароля</h2>
    <div class="block">
        <form class="form" action="{{route('account.data.password')}}">
            <div class="block row">
                <input type="password" class="input-text" name="password" placeholder="Новый пароль">
                <input type="password" class="input-text" name="password_repeat" placeholder="Старый пароль">
            </div>
            <input type="submit" class="btn data-sbmt" value="Изменить">
        </form>
    </div>
    <script src="{{asset('/js/acc-data.js')}}"></script>
@endsection


