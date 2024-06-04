@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>{{$category->title}}</h1>
        <div class="catalog">
            @foreach($products as $product)
               <x-product-card :$product></x-product-card>
            @endforeach
            <div class="catalog__pagination">
                {{$products->links('vendor.pagination.custom')}}
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{asset('/css/catalog.css')}}">
    <script src="{{asset('/js/catalog.js')}}"></script>
@endsection
