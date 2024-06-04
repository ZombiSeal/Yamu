
    <div class="admin-container__content">
        <div class="admin-container__row row">
            <h2>Продукты</h2>
            <x-button href="{{route('admin.products', ['action'=>'add'])}}">Добавить</x-button>
        </div>

        @if(!$products->isEmpty())
            <div class="admin-container__list">
                <div class="admin-container__item">
                    <div class="admin-container__th">
                        <div class="list-row">
                            <p class="acent acent--s">id</p>
                            <p class="acent acent--s  admin-container__item admin-container__item--m">Название</p>
                            <p class="acent acent--s">Картинка</p>
                            <p class="acent acent--s">Категория</p>
                            <p class="acent acent--s admin-container__item admin-container__item--l">Описание</p>
                            <p class="acent acent--s">Вес</p>
                            <p class="acent acent--s">Цена</p>
                            <p class="acent acent--s">Скидка</p>
                            <p class="acent acent--s">Активность</p>
                        </div>
                    </div>
                    <div class="admin-container__body">
                        @foreach($products as $product)
                            <div class="admin-container__tr">
                                <div class="list-row">
                                    <p>{{$product->id}}</p>
                                    <p class=" admin-container__item admin-container__item--m">{{$product->title}}</p>
                                    <div class="admin-container__img">
                                        <img src="{{asset('/images/products/'.$product->img_path)}}" alt="">
                                    </div>
                                    <p class=" admin-container__item">{{$product->category->title}}</p>
                                    <p class="admin-container__item admin-container__item--l">{{$product->description}}</p>
                                    <p>{{$product->weight}} г</p>
                                    <p>{{$product->price}} руб.</p>
                                    <p>{{($product->sale) ? $product->sale->percent . '%' : ''}}</p>
                                    <p>{{($product->is_active) ? "Да" : "Нет"}}</p>
                                </div>
                                <div class="admin-container__btn">
                                    <a class="admin-container__icon" data-action="edit" href="{{route('admin.products', ['action'=>'edit', 'id' => $product->id])}}">
                                        <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                                        </svg>
                                    </a>
                                    <div class="admin-container__icon del" data-action="{{route('admin.del', ['table' => 'product'])}}" data-id="{{$product->id}}">
                                        <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="/images/svg/icon-del.svg#icon-del"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="catalog__pagination">
                {{$products->links('vendor.pagination.custom')}}
            </div>
        @else
            <p>Нет пользователей</p>
        @endif
    </div>

