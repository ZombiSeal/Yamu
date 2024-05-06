<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules():array
    {
        return [
            'phone' => ['required', 'regex:/^\+375\((29|33|44|17)\)\d{3}-\d{2}-\d{2}/'],
        ];
    }

    public  function  messages():array
    {
        return [
            'phone.required' => 'Заполните поле',
            'phone.regex' => 'Неверный формат телефона'
        ];
    }
}
