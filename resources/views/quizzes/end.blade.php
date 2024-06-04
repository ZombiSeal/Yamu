@extends('layouts.main')
@section('content')
    <div class="container end quiz">
        <h1>Квиз окончен</h1>
        <div >
            <p class="acent">{{$text}}</p>
            <div>
                @if($status === "fail")
                    <x-button href="{{route('quizzes.detail', ['id' => $quizId])}}">Повторить попытку</x-button>
{{--                    <a class="btn" href="{{route('quizzes.detail', ['id' => $quizId])}}">Повторить попытку</a>--}}
                @else
                    <x-button href="{{route('account.coupons')}}">Личный кабинет</x-button>
                @endif
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
@endsection
