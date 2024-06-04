<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'code' => 'required|unique:coupons,code|min:2',
            'sale' => 'required',
        ];
    }

    public  function  messages():array
    {
        return [
            'required' => 'Заполните поле',
            'code.unique' => 'Такой купон уже существует',
            'min' => 'Недостаточная длина'
        ];
    }
}
