@extends('layouts.admin')
@section('content')
    @if(!request()->route('action'))
        @include('admin.quizzes.quizzes-all');
    @else
        @if(request()->route('action') === 'add')
            @include('admin.quizzes.quizzes-add')
        @endif

        @if(request()->route('action') === 'questions')
            @include('admin.quizzes.quizzes-add-questions')
        @endif

        @if(request()->route('action') === 'edit')
            @include('admin.quizzes.quizzes-edit')
        @endif
    @endif
@endsection
