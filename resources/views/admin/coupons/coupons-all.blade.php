<div class="admin-container__content">
    <div class="admin-container__row row">
        <h2>Купоны</h2>
        <x-button href="{{route('admin.coupons', ['action'=>'add'])}}">Добавить</x-button>
    </div>

    @if(!$coupons->isEmpty())
        <div class="admin-container__list">
            <div class="admin-container__item">
                <div class="admin-container__th">
                    <div class="list-row">
                        <p class="acent acent--s">id</p>
                        <p class="acent acent--s">Купон</p>
                        <p class="acent acent--s">Скидка</p>
                        <p class="acent acent--s">Для квиза</p>
                        <p class="acent acent--s">Активность</p>
                    </div>
                </div>
                <div class="admin-container__body">
                    @foreach($coupons as $coupon)
                        <div class="admin-container__tr">
                            <div class="list-row">
                                <p>{{$coupon->id}}</p>
                                <p class=" admin-container__item">{{$coupon->code}}</p>
                                <p>{{$coupon->sale->percent}} %</p>
                                <p>{{($coupon->quiz) ? "Да" : "Нет"}}</p>
                                <p>{{($coupon->is_active) ? "Да" : "Нет"}}</p>
                            </div>
                            <div class="admin-container__btn">
                                <a class="admin-container__icon" data-action="edit"
                                   href="{{route('admin.coupons', ['action'=>'edit', 'id' => $coupon->id])}}">
                                    <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                                    </svg>
                                </a>
                                @if(!$coupon->quiz)
                                    <div class="admin-container__icon del"
                                         data-action="{{route('admin.del', ['table' => 'coupon'])}}"
                                         data-id="{{$coupon->id}}">
                                        <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="/images/svg/icon-del.svg#icon-del"></use>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="catalog__pagination">
            {{$coupons->links('vendor.pagination.custom')}}
        </div>
    @else
        <p>Нет пользователей</p>
    @endif
</div>

