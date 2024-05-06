@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Квиз окончен</h1>
        <div class="row">
            <p class="acent">{{$text}}</p>
            <div>
                @if($status === "fail")
                    <a class="btn" href="{{route('quizzes.detail', ['id' => $quizId])}}">Повторить попытку</a>
                @else
                    <a class="btn" href="{{route('account')}}">Личный кабинет</a>
                @endif
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
@endsection
