<div class="admin-container__content">
    <h2>Изменение купона</h2>
    <form class="quiz-add-form" action="{{route('admin.coupons.addData', ['action'=>'edit', 'id'=>$coupon->id])}}" method="post">
        <div class="admin-container__col">
            <x-radio class="" type="checkbox" name="isActive" id="1" checked="{{$coupon->is_active}}">Активность</x-radio>
            <div class="admin-container__row" style="width: 100%">
                <div class="item">
                    <x-input class="validate" name="code" type="text" value="{{$coupon->code}}">Купон*</x-input>
                    <div class="input-error"></div>
                </div>
                @if(!$sales->isEmpty())
                    <div class="item" style="display:flex; align-items: center; gap:20px; width: 100%">
                        <div>Скидка*:</div>
                        <select name="sale" id="coupon">
                            @foreach($sales as $sale)
                                <option value="{{$sale->id}}"
                                    {{($coupon->sale_id === $sale->id) ? "selected" : ''}}
                                >
                                    {{$sale->title}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
        <x-button class="admin-container__sbmt add">Изменить</x-button>
    </form>
</div>

