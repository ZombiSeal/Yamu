@extends('layouts.admin')
@section('content')
    @if(!request()->route('action'))
        @include('admin.products.products-all')
    @else
        @if(request()->route('action') === 'add')
            @include('admin.products.products-add')
        @endif

        @if(request()->route('action') === 'edit')
            @include('admin.products.products-edit')
        @endif
    @endif
@endsection
