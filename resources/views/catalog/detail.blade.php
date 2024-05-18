@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>{{$product->title}}</h1>
    </div>
    <link rel="stylesheet" href="{{asset('/css/catalog.css')}}">
@endsection
