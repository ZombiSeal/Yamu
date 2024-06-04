@extends('layouts.main')
@section('content')
    <div class="container quiz">
        <h1>{{$quiz->title}}</h1>

        <div class="quiz-container row" data-id="{{$quiz->id}}">
            <div class="quiz__question" >
                <x-question :$quiz :$count :$questions :$question :$answers></x-question>
            </div>

            <div class="quiz-wrapper__count pulse">
                <p class="acent"><span class="count">{{$count}}</span>/{{$questions}}</p>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
    <script src="{{asset('/js/quiz.js')}}"></script>
@endsection
