<div class="admin-container__content">
    <h2>Изменение пользователя</h2>
    <form class="quiz-add-form" action="{{route('admin.users.addData', ['action'=>'edit', 'id'=>$user->id])}}" method="post">
        <div class="row">
            <div class="admin-container__col">
                @if(auth()->user()->id !== $user->id)
                <select name="role" id="coupon">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}"
                            {{($user->role_id === $role->id) ? "selected" : ''}}>
                            {{$role->title}}
                        </option>
                    @endforeach
                </select>
                @endif
                <div>
                    <x-input class="validate" name="name" type="text" value="{{$user->name}}">Имя*</x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate" name="email" type="email" value="{{$user->email}}">Email*
                    </x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate no-require" name="phone" type="text" value="{{$user->phone}}">
                        Телефон
                    </x-input>
                    <div class="input-error"></div>
                </div>
                <div class="account">
                    <x-input name="birthday" type="date" value="{{$user->birthday}}">Дата рождения</x-input>
                </div>
            </div>
            <div class="admin-container__col">
                <div>
                    <x-input class="validate" name="password" type="password">Новый пароль</x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate" name="password_repeat" type="password">Повторите пароль</x-input>
                    <div class="input-error"></div>
                </div>
            </div>
        </div>

        <x-button class="admin-container__sbmt add">Изменить</x-button>
    </form>
</div>

