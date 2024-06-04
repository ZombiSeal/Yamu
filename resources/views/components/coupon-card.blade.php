<div class="coupon" data-id="{{$coupon->id}}">
    <div class="coupon__info">
        <p class="coupon__code acent acent--s">{{$coupon->code}}</p>
        <p class="coupon__desc small">{{$coupon->sale->title}}</p>
    </div>
    @if($type === "coupon")
    <button class="coupon__del">
        <svg class="icon icon--l" width="25" height="25" viewBox="0 0 60 60"
             xmlns="http://www.w3.org/2000/svg">
            <use href="/images/svg/icon-close.svg#close"></use>
        </svg>
    </button>
    @endif
</div>
