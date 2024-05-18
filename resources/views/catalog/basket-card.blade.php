<div class="basket-card">
    <div class="basket-card__img {{($type === 'order') ? 'basket-card__img--s' : ''}}">
        <img src="{{asset('/images/ramen.png')}}" alt="">
    </div>
    <div class="basket-card__info {{($type === 'order') ? 'basket-card__info--s' : ''}}">
        <div class="acent acent--s">Филадельфия Сан сет (промо акция)</div>
        <div class="row basket-card__row">
            <x-number></x-number>
            <div class="basket-card__text">
                <p class="basket-card__price acent {{($type === 'order') ? '' : 'acent--l'}}">19.99 руб.</p>
                <p class="basket-card__weight">111 г</p>
            </div>
        </div>
    </div>
    <button class="basket-card__del">
        <svg class="icon icon--l" width="25" height="25" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
            <use href="/images/svg/icon-close.svg#close"></use>
        </svg>
    </button>
</div>
