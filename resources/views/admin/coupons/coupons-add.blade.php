<div class="admin-container__content">
    <h2>Добавление купона</h2>
    <form class="quiz-add-form" action="{{route('admin.coupons.addData', ['action'=>'add'])}}" method="post">
        <div class="row">
            <div class="admin-container__row" style="width: 100%">
                <div class="item">
                    <x-input class="validate" name="code" type="text">Купон*</x-input>
                    <div class="input-error"></div>
                </div>
                @if(!$sales->isEmpty())
                    <div class="item" style="display:flex; align-items: center; gap:20px; width: 100%">
                        <div>Скидка*:</div>
                        <select name="sale" id="coupon">
                            @foreach($sales as $sale)
                                <option value="{{$sale->id}}">{{$sale->title}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
        <x-button class="admin-container__sbmt add">Добавить</x-button>
    </form>
</div>

