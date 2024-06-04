
    <div class="admin-container__content">
        <h2>Добавление вопросов</h2>
        <form action="{{route('admin.quizzes.addDataQuestions', ['id' => request()->route('id')])}}" method="post">
            @csrf
            <div class="admin-container__col">
                <div>
                    <x-input class="validate" name="question" type="text">Вопрос*</x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate answer" name="answer[]" type="text">Верный ответ*</x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate answer" name="answer[]" type="text">Ответ*</x-input>
                    <div class="input-error"></div>
                </div>
                <div>
                    <x-input class="validate answer" name="answer[]" type="text">Ответ*</x-input>
                    <div class="input-error"></div>
                </div>
            </div>

            <div class="row">
                <x-button class="admin-container__sbmt questions-add" data-action="add">Добавить</x-button>
                <x-button class="admin-container__sbmt btn--m questions-add" data-action="continue">Добавить и продолжить</x-button>
            </div>
        </form>
        {{--        <x-radio class="" type="checkbox" name="radio" id="1">Активен</x-radio>--}}
    </div>

