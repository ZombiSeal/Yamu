@extends('layouts.admin')
@section('content')
    <div class="admin-container__content">
        <h2>Бронирование</h2>
        @if(!$tables->isEmpty())
            <div class="admin-container__list">
                <div class="admin-container__item">
                    <div class="admin-container__th">
                        <div class="list-row list-row--l">
                            <p class="acent acent--s">id</p>
                            <p class="acent acent--s">Номер столика</p>
                            <p class="acent acent--s">Имя</p>
                            <p class="acent acent--s">Телефон</p>
                            <p class="acent acent--s">Дата</p>
                            <p class="acent acent--s">Время</p>
                            <p class="acent acent--s">Активно</p>
                        </div>
                    </div>
                    <div class="admin-container__body">
                        @foreach($tables as $table)
                            <div class="admin-container__tr admin-container__tr--block">
                                <div class="list-row list-row--l">
                                    <p>{{$table->id}}</p>
                                    <p>{{$table->table->number}}</p>
                                    <p>{{$table->name}}</p>
                                    <p>{{$table->phone}}</p>
                                    <p>{{$table->date}}</p>
                                    <p>{{$table->time}}</p>
                                    <div class="admin-container__radio">
                                        <x-radio type="checkbox" name="isActive"
                                                  id="{{$table->id}}" checked="{{$table->is_active}}"></x-radio>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="catalog__pagination">
                {{$tables->links('vendor.pagination.custom')}}
            </div>
        @else
            <p>Нет забронированных столиков</p>
        @endif
    </div>

@endsection
