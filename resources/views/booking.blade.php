@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Бронирование</h1>
        <form class="book-form" action="{{route('booking.reserve')}}" method="post">
            <div class="row">
                <div class="row__item">
                    <label for="">Ваше имя*:</label>
                    <input type="text" class="input-text" name="name" placeholder="Имя">
                </div>
                <div class="row__item">
                    <label for="">Ваш телефон*:</label>
                    <input type="text" class="input-text" name="phone" placeholder="Телефон">
                </div>
                <div class="row__item">
                    <label for="">Выберите дату*:</label>
                    <input type="date" class="input-text" name="date" value="{{date('Y-m-d') }}" placeholder="Дата"
                           min="{{date('Y-m-d') }}" max="{{date('Y-m-d', strtotime('+1 month'))}}"
                    >
                </div>
                <div class="row__item">
                    <label for="">Ваш время*:</label>
                    <input type="time" class="input-text" name="time" placeholder="Время" min="10:00" max="23:00">
                </div>
            </div>

            <div class="row">
                @foreach ($tables as $table)
                    <div class="table @if(in_array($table->number, $bookTables)) table--reserve @endif "
                         data-id="{{$table->id}}"
                         data-number="{{$table->number}}"
                    >
                        <input type="radio"
                               name="table_id"
                               value="{{$table->id}}"
                               @if(in_array($table->number, $bookTables)) disabled @endif
                        >
                        <p>{{$table->number}}</p>
                        <p>{{$table->capacity}} места</p>
                    </div>
                @endforeach
            </div>

            <button class="book-form__sbmt btn">Забронировать</button>
        </form>

    </div>

    <link rel="stylesheet" href="{{asset('/css/booking.css')}}">
    <script src="{{asset('/js/booking.js')}}"></script>
@endsection
