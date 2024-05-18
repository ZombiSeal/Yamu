@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Каталог</h1>
        <div class="catalog">
            @foreach($products as $product)
                <div class="catalog__item product-card {{(session('basket.' . $product->id)) ? "active" : ""}}">
                    @if(!$product->labels->isEmpty())
                        <div class="product-card__labels">
                            @foreach($product->labels as $label)
                                <svg width="35" height="35" viewBox="0 0 60 60" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="/images/svg/{{$label->icon}}#svg"></use>
                                </svg>
                            @endforeach
                        </div>
                    @endif
                    <a class="product-card__img product-card__link"
                       href="{{route('catalog.detail', ['category' => request()->route('category'),'id' => $product->id])}}">
                        <img src="{{asset('/images/'.$product->img_path)}}" alt="">
                    </a>
                    <a class="product-card__title product-card__link acent acent--s"
                       href="{{route('catalog.detail', ['category' => request()->route('category'),'id' => $product->id])}}">{{$product->title}}</a>
                    <div class="product-card__info product-card__row row">
                        @if($product->salePrice)
                            <div class="product-card__col">
                                <div class="product-card__price acent acent--l">{{$product->salePrice}} руб.</div>
                                <div class="product-card__price product-card__price--old">{{$product->price}} руб.</div>
                            </div>
                        @else
                            <div class="product-card__price acent acent--l">{{$product->price}} руб.</div>
                        @endif
                        <div class="product-card__weight">{{$product->weight}} г</div>
                    </div>
                    <div class="product-card__row row">
                        <x-number value="{{(session('basket.' . $product->id)) ?: 0}}"></x-number>
                        <div class="product-card__basket basket" data-id="{{$product->id}}">
                            <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <use href="/images/svg/icon-shop.svg#shop"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="catalog__pagination">
                {{$products->links('vendor.pagination.custom')}}
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('/css/catalog.css')}}">
    <script src="{{asset('/js/catalog.js')}}"></script>
@endsection
