@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Квизы</h1>
        @guest
            <div>Авторизируйтесь или зарегестрируйтесь, чтобы получить доступ</div>
        @else
            <div class="quiz-wrapper">
                @if($quizzes->isEmpty())
                    <p>На данный момент нет доступных квизов</p>
                @else
                    @foreach($quizzes as $quiz)
                        <a href="{{route('quizzes.detail', ['id' => $quiz->id])}}" class="quiz-wrapper__card">
                            <img src="/images/{{$quiz->img_path}}" alt="">
                            <span class="quiz-wrapper__text">
                     <p class="acent">{{$quiz->title}}</p>
                    <p>{{$quiz->description}}</p>
                </span>
                        </a>
                    @endforeach
                @endif
            </div>
        @endguest
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
@endsection
