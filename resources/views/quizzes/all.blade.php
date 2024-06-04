@extends('layouts.main')
@section('content')
    <div class="container quiz">
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
                            <img src="/images/quizzes/{{$quiz->img_path}}" alt=""/>
                            <div class="quiz-wrapper__text">
                                 <p class="quiz-wrapper__title acent">{{$quiz->title}}</p>
                                 <p class="quiz-wrapper__desc">{{$quiz->description}}</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        @endguest
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
@endsection
