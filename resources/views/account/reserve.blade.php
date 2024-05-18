@extends('layouts.account')
@section('info')
    <h2>Бронирование</h2>
    <div class="tables-wrapper">
        @foreach($tables as $table)
            <div class="table row" data-id="{{$table->id}}">
                <div class="table__info row">
                    <div class="table__item">
                        <p class="acent">Бронь на {{$table->date}} ({{$table->table->capacity}} места)</p>
                        <p>Время: {{$table->time}} </p>
                    </div>
                    <div class="table__item">
                        <p>Имя: {{$table->name}}</p>
                        <p>Телефон: {{$table->phone}}</p>
                    </div>
                </div>

                @if($table->date > date('d.m.Y'))
                    <div class="table__item table__action">
                        @if($table->is_active)
                            <a class="table__icon edit" href="{{{route('booking', ['action' => 'edit','id' => $table->id])}}}">
                                <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                                </svg>
                            </a>
                            <div class="table__icon cancel">
                                <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="/images/svg/icon-del.svg#icon-del"></use>
                                </svg>
                            </div>
                        @else
                            <div class="table__no-reserve">Отменено</div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <script src="{{asset('/js/acc-reserve.js')}}"></script>
@endsection


