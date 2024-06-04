<div class="admin-container__content">
    <h2>Пользователи</h2>
    @if(!$users->isEmpty())
        <div class="admin-container__list">
            <div class="admin-container__item">
                <div class="admin-container__th">
                    <div class="list-row">
                        <p class="acent acent--s">id</p>
                        <p class="acent acent--s">Роль</p>
                        <p class="acent acent--s">Имя</p>
                        <p class="acent acent--s">Email</p>
                        <p class="acent acent--s">Телефон</p>
                        <p class="acent acent--s">Дата рождения</p>
                    </div>
                </div>
                <div class="admin-container__body">
                    @foreach($users as $user)
                        <div class="admin-container__tr">
                            <div class="list-row">
                                <p>{{$user->id}}</p>
                                <p>{{$user->role->title}}</p>
                                <p>{{$user->name}}</p>
                                <p>{{$user->email}}</p>
                                <p>{{$user->phone}}</p>
                                <p>{{$user->birthday}}</p>
                            </div>
                            <div class="admin-container__btn">
                                <a class="admin-container__icon" data-action="edit" href="{{route('admin.users', ['action'=>'edit', 'id' => $user->id])}}">
                                    <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                                    </svg>
                                </a>
                                <div class="admin-container__icon del" data-action="{{route('admin.del', ['table' => 'user'])}}" data-id="{{$user->id}}">
                                    <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="/images/svg/icon-del.svg#icon-del"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="catalog__pagination">
            {{$users->links('vendor.pagination.custom')}}
        </div>
    @else
        <p>Нет пользователей</p>
    @endif
</div>
