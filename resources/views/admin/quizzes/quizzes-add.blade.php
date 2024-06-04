<div class="admin-container__content">
    <h2>Добавление квиза</h2>
    @if(!$coupons->isEmpty())
        <form class="quiz-add-form" action="{{route('admin.quizzes.addData', ['action'=>'add'])}}" method="post">
            <div class="row">
                <div class="admin-container__col admin-container__col--l">
                    <div>
                        <x-input class="validate" name="title" type="text">Название*</x-input>
                        <div class="input-error"></div>
                    </div>
                    <div>
                        <x-input class="validate" name="description" type="text">Описание*</x-input>
                        <div class="input-error"></div>
                    </div>

                    <div>
                        <p>Купон*</p>
                        <select name="coupon" id="coupon">
                            @foreach($coupons as $coupon)
                                <option value="{{$coupon->id}}">{{$coupon->code}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="admin-container__col admin-container__col--s">
                    <div class="input-file">
                            <span>Картинка*:</span>
                        <label class="input-file__label">
                            <div class="input-file__title">
                                <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path id="Vector"
                                          d="M12 2V8.5C12 8.87288 12.1389 9.23239 12.3896 9.50842C12.6403 9.78445 12.9848 9.9572 13.356 9.993L13.5 10H20V20C20.0002 20.5046 19.8096 20.9906 19.4665 21.3605C19.1234 21.7305 18.6532 21.9572 18.15 21.995L18 22H6C5.49542 22.0002 5.00943 21.8096 4.63945 21.4665C4.26947 21.1234 4.04284 20.6532 4.005 20.15L4 20V4C3.99984 3.49542 4.19041 3.00943 4.5335 2.63945C4.87659 2.26947 5.34684 2.04284 5.85 2.005L6 2H12ZM14 2.043C14.3234 2.11165 14.6247 2.25939 14.877 2.473L15 2.586L19.414 7C19.6483 7.23411 19.8208 7.52275 19.916 7.84L19.956 8H14V2.043Z"
                                    />
                                </svg>
                                <span class="title">Выбрать файл</span>
                            </div>
                            <input id="image-input" name="image" type="file"/>
                        </label>
                    </div>
                    <div class="image-preview">
                        <div class="image-preview__block">
                            <img class="image-preview__img" id="preview-image" src="#" alt="Preview Image"
                                 style="display: none;">
                            <button class="image-preview__btn" type="button" id="remove-image" style="display: none;">
                                <svg width="30" height="30" viewBox="0 0 60 60" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path id="close"
                                          d="M45.7496 14.2746C45.5183 14.0428 45.2436 13.859 44.9411 13.7335C44.6387 13.608 44.3145 13.5435 43.9871 13.5435C43.6597 13.5435 43.3354 13.608 43.033 13.7335C42.7306 13.859 42.4559 14.0428 42.2246 14.2746L29.9996 26.4746L17.7746 14.2496C17.5431 14.0181 17.2684 13.8345 16.9659 13.7093C16.6635 13.584 16.3394 13.5195 16.0121 13.5195C15.6848 13.5195 15.3606 13.584 15.0582 13.7093C14.7558 13.8345 14.481 14.0181 14.2496 14.2496C14.0181 14.481 13.8345 14.7558 13.7093 15.0582C13.584 15.3606 13.5195 15.6848 13.5195 16.0121C13.5195 16.3394 13.584 16.6635 13.7093 16.9659C13.8345 17.2684 14.0181 17.5431 14.2496 17.7746L26.4746 29.9996L14.2496 42.2246C14.0181 42.456 13.8345 42.7308 13.7093 43.0332C13.584 43.3356 13.5195 43.6598 13.5195 43.9871C13.5195 44.3144 13.584 44.6385 13.7093 44.9409C13.8345 45.2433 14.0181 45.5181 14.2496 45.7496C14.481 45.981 14.7558 46.1646 15.0582 46.2899C15.3606 46.4152 15.6848 46.4796 16.0121 46.4796C16.3394 46.4796 16.6635 46.4152 16.9659 46.2899C17.2684 46.1646 17.5431 45.981 17.7746 45.7496L29.9996 33.5246L42.2246 45.7496C42.456 45.981 42.7308 46.1646 43.0332 46.2899C43.3356 46.4152 43.6598 46.4796 43.9871 46.4796C44.3144 46.4796 44.6385 46.4152 44.9409 46.2899C45.2433 46.1646 45.5181 45.981 45.7496 45.7496C45.981 45.5181 46.1646 45.2433 46.2899 44.9409C46.4152 44.6385 46.4796 44.3144 46.4796 43.9871C46.4796 43.6598 46.4152 43.3356 46.2899 43.0332C46.1646 42.7308 45.981 42.456 45.7496 42.2246L33.5246 29.9996L45.7496 17.7746C46.6996 16.8246 46.6996 15.2246 45.7496 14.2746Z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="image-preview__title" id="preview-name"></div>
                    </div>
                </div>
            </div>
            <x-button class="admin-container__sbmt add">Добавить</x-button>
        </form>
    @else
        <p>Нет свободных купонов. Для добавления квиза необходимо добавить новый купон</p>
    @endif
</div>

