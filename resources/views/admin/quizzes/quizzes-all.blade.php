
    <div class="admin-container__content">
        <div class="admin-container__row row">
            <h2>Квизы</h2>
            <x-button href="{{route('admin.quizzes', ['action'=>'add'])}}">Добавить</x-button>
        </div>

        @if(!$quizzes->isEmpty())
            <div class="admin-container__list">
                <div class="admin-container__item">
                    <div class="admin-container__th">
                        <div class="list-row">
                            <p class="acent acent--s">id</p>
                            <p class="acent acent--s">Название</p>
                            <p class="acent acent--s">Картинка</p>
                            <p class="acent acent--s">Описание</p>
                            <p class="acent acent--s">Купон</p>
                            <p class="acent acent--s">Активность</p>
                        </div>
                    </div>
                    <div class="admin-container__body">
                        @foreach($quizzes as $quiz)
                            <div class="admin-container__tr">
                                <div class="list-row">
                                    <p>{{$quiz->id}}</p>
                                    <p>{{$quiz->title}}</p>
                                    <div class="admin-container__img">
                                        <img src="{{asset('/images/quizzes/'.$quiz->img_path)}}" alt="">
                                    </div>
                                    <p>{{$quiz->description}}</p>
                                    <p>{{$quiz->coupon->code}}</p>
                                    <p>{{($quiz->is_active) ? "Да" : "Нет"}}</p>
                                </div>
                                <div class="admin-container__btn">
                                    <a class="admin-container__icon" data-action="add" href="{{route('admin.quizzes', ['action' =>'questions', 'id' => $quiz->id])}}">
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="/images/svg/icon-add.svg#icon-add"></use>
                                        </svg>
                                    </a>
                                    <a class="admin-container__icon" data-action="edit" href="{{route('admin.quizzes', ['action'=>'edit', 'id' => $quiz->id])}}">
                                        <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <use href="/images/svg/icon-edit.svg#icon-edit"></use>
                                        </svg>
                                    </a>
                                    <div class="admin-container__icon del" data-action="{{route('admin.del', ['table'=>'quiz'])}}" data-id="{{$quiz->id}}">
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
                {{$quizzes->links('vendor.pagination.custom')}}
            </div>
        @else
            <p>Нет пользователей</p>
        @endif
    </div>

