@extends('layouts.admin')
@section('content')
    <div class="admin-container__content">
        <h2>Заказы</h2>
        @if(!$orders->isEmpty())
            <div class="admin-container__list">
                <div class="admin-container__item">
                    <div class="admin-container__th">
                        <div class="list-row list-row--l">
                            <p class="acent acent--s">id</p>
                            <p class="acent acent--s">Номер заказа</p>
                            <p class="acent acent--s">Имя</p>
                            <p class="acent acent--s">Телефон</p>
                            <p class="acent acent--s">Дата</p>
                            <p class="acent acent--s">Время</p>
                            <p class="acent acent--s admin-container__item--l">Комментарий</p>
                            <p class="acent acent--s">Статус</p>
                        </div>
                    </div>
                    <div class="admin-container__body">
                        @foreach($orders as $order)
                            <div class="admin-container__tr admin-container__tr--block">
                                <div class="list-row list-row--l">
                                    <p>{{$order->id}}</p>
                                    <p>{{$order->number}}</p>
                                    <p>{{$order->name}}</p>
                                    <p>{{$order->phone}}</p>
                                    <p>{{$order->date}}</p>
                                    <p>{{$order->delivery_time}}</p>
                                    <p class="admin-container__item--l">{{$order->comment}}</p>

                                    <div class="admin-container__radio">
                                        <select name="status" id="status" data-id="{{$order->id}}">
                                            @foreach($statuses as $status)
                                                <option value="{{$status->id}}"
                                                    {{($status->id === $order->status_id) ? "selected" : ''}}
                                                >
                                                    {{$status->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="catalog__pagination">
                {{$orders->links('vendor.pagination.custom')}}
            </div>
        @else
            <p>Нет заказов</p>
        @endif
    </div>

@endsection
