@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>{{$quiz->title}}</h1>

        <div class="quiz quiz-container" data-id="{{$quiz->id}}">
            <div class="quiz__question" >
                <x-question :$quiz :$count :$questions :$question :$answers></x-question>
            </div>

            <div class="timer">

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{asset('/css/quiz.css')}}">
    <script src="{{asset('/js/quiz.js')}}"></script>
@endsection
