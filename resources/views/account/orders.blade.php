@extends('layouts.account')
@section('info')
    <h2>Мои заказы</h2>
    @if(!$orders->isEmpty())
        <div class="list">
            <div class="list__header">
                <div class="list-row row">
                    <p class="acent acent--s">№заказа</p>
                    <p class="acent acent--s">Кол-во позиций</p>
                    <p class="acent acent--s">Дата</p>
                    <p class="acent acent--s">Статус</p>
                    <p class="acent acent--s">Итого</p>
                </div>
            </div>
            <div class="accordion list__content">
                @foreach($orders as $order)
                    <div class="accordion__item" data-id="{{$order->id}}">
                        <button class="accordion__header">
                            <div class="list-row row">
                                <p>{{$order->number}}</p>
                                <p>{{$order->quantity}} шт</p>
                                <p>{{$order->date}}</p>
                                <p>{{$order->status->title}}</p>
                                <p>{{($order->salePrice) ?: $order->fullPrice}} руб.</p>
                            </div>
                            <div class="accordion__btn">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.4439 8.27045C22.1509 7.97753 21.7535 7.81297 21.3392 7.81297C20.9249 7.81297 20.5275 7.97753 20.2345 8.27045L12.5001 16.0048L4.76576 8.27045C4.47107 7.98583 4.07638 7.82834 3.6667 7.8319C3.25701 7.83546 2.86512 7.99978 2.57542 8.28948C2.28572 8.57918 2.12139 8.97108 2.11783 9.38076C2.11427 9.79044 2.27177 10.1851 2.55639 10.4798L11.3955 19.3189C11.6885 19.6118 12.0858 19.7764 12.5001 19.7764C12.9145 19.7764 13.3118 19.6118 13.6048 19.3189L22.4439 10.4798C22.7368 10.1868 22.9014 9.78946 22.9014 9.37514C22.9014 8.96082 22.7368 8.56346 22.4439 8.27045Z"
                                        fill="white"/>
                                </svg>
                            </div>
                        </button>
                        <div class="accordion__content">
                            @foreach($info[$order->id] as $item)
                                <div class="account-card">
                                    <div class="account-card__item row">
                                        <div class="account-card__img">
                                            <img src="{{asset('/images/products/'.$item->product->img_path)}}" alt="">
                                        </div>
                                        <div class="account-card__col">
                                            <div class="account-card__title acent acent--s">{{$item->product->title}}
                                            </div>
                                            <div>
                                                <p class="quantity">Количество: <span>{{$item->quantity}} шт</span></p>
                                                <p class="weight">Вес (за 1 порцию): <span>{{$item->product->weight}} г</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="acent">{{$item->product->fullPrice}} руб.</p>
                                </div>
                            @endforeach
                            <div class="accordion__all row">
                                @if($order->coupon)
                                    <div class="accordion__row row">
                                        <x-coupon-card type="info" :coupon="$order->coupon"></x-coupon-card>
                                        <div class="accordion__prices">
                                            <p>Сумма заказа: {{$order->fullPrice}}</p>
                                            <p class="accordion__price total-price acent">Итого: <span>{{$order->salePrice}} руб.</span>
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <p class="accordion__price total-price acent">Итого: <span>{{$order->fullPrice}} руб.</span></p>
                                @endif

                                <x-button class="repeat-order btn--m">Повторить заказ</x-button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="catalog__pagination">
            {{$orders->links('vendor.pagination.custom')}}
        </div>
    @else
        <p>У вас нет заказов</p>
    @endif
@endsection


