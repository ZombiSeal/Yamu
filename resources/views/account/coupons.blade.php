@extends('layouts.account')
@section('info')
    <h2>Мои купоны</h2>
    @if(!$coupons->isEmpty())
    <div class="coupons-list row">
        @foreach($coupons as $coupon)
            <div class="coupons-list__item">
                <p class="coupons-list__title acent">{{$coupon->coupon->code}}</p>
                <p>{{$coupon->couponSale->title}}</p>
            </div>
        @endforeach
    </div>
    @else
        <p>У вас нет купонов</p>
    @endif
@endsection


