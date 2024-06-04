@extends('layouts.main')
@section('content')
    <div class="container detail">
        <div class="detail__attributes attr">
            <div class="attr__item">
                <div class="attr__icon">
                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="{{asset('/images/svg/icon-solar.svg')}}#icon-solar"></use>
                    </svg>
                </div>
                <div class="attr__title">Жиры</div>
                <div class="attr__desc">{{$product->attribute->fats}}</div>
            </div>
            <div class="attr__item">
                <div class="attr__icon">
                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="{{asset('/images/svg/icon-carb.svg')}}#icon-carb"></use>
                    </svg>
                </div>
                <div class="attr__title">Углеводы</div>
                <div class="attr__desc">{{$product->attribute->carbs}}</div>
            </div>
            <div class="attr__item">
                <div class="attr__icon">
                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="{{asset('/images/svg/icon-protein.svg')}}#icon-protein"></use>
                    </svg>
                </div>
                <div class="attr__title">Белки</div>
                <div class="attr__desc">{{$product->attribute->protein}}</div>
            </div>
            <div class="attr__item">
                <div class="attr__icon">
                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="{{asset('/images/svg/icon-calories.svg')}}#icon-calories"></use>
                    </svg>
                </div>
                <div class="attr__title">кКал</div>
                <div class="attr__desc">{{$product->attribute->calories}}</div>
            </div>
        </div>
        <div class="detail__line"></div>
        <div class="detail__img">
            <img src="{{asset('/images/products/'.$product->img_path)}}" alt="">
        </div>
        <div class="detail__info">
            <div class="detail__info-wrapper">
                <h1 class="detail__title">{{$product->title}}</h1>
                <div class="detail__desc">{{$product->description}}</div>
                <div class="detail__weight">Вес порции: {{$product->weight}} г</div>
                @if($product->salePrice)
                    <div class="detail__price">
                        <div class="detail__price--new like-h2">{{$product->salePrice}} руб.</div>
                        <div class="detail__price--old">{{$product->price}} руб.</div>
                    </div>
                @else
                    <div class="detail__price acent acent--l">{{$product->price}} руб.</div>
                @endif

                <div class="detail__row">
                    <x-number value="{{$capacity}}"></x-number>
                    <div class="basket-btn" data-id="{{$product->id}}">
                        <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <use href="/images/svg/icon-shop.svg#shop"></use>
                        </svg>
                        В корзину
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('/css/catalog.css')}}">
    <script src="{{asset('/js/catalog.js')}}"></script>
@endsection
