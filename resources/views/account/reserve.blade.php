@extends('layouts.account')
@section('info')
    <h2>Бронирование</h2>
    <div class="tables-wrapper">
        @foreach($tables as $table)
            <div class="table row" data-id="{{$table->id}}">
                <div class="table__info">
                    <p>Бронь на: {{$table->date}} {{$table->time}}</p>
                    <p>Имя: {{$table->name}}</p>
                    <p>Телефон: {{$table->phone}}</p>
                </div>

                @if($table->date >= date('Y-m-d') && $table->is_active)
                    <button class="cancel">Отменить</button>
                @endif
            </div>
        @endforeach
    </div>

    <script src="{{asset('/js/acc-reserve.js')}}"></script>
@endsection


