@extends('layouts.admin')
@section('content')
    @if(!request()->route('action'))
        @include('admin.coupons.coupons-all')
    @else
        @if(request()->route('action') === 'add')
            @include('admin.coupons.coupons-add')
        @endif

        @if(request()->route('action') === 'edit')
            @include('admin.coupons.coupons-edit')
        @endif
    @endif
@endsection
