@extends('layouts.admin')
@section('content')
    @if(!request()->route('action'))
        @include('admin.users.users-all')
    @else
        @if(request()->route('action') === 'edit')
            @include('admin.users.users-edit')
        @endif
    @endif
@endsection
