<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NameRequest extends FormRequest
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
            'name' => 'required|regex:/^([A-Za-zА-Яа-я-]{2,})$/u',
        ];
    }

    public  function  messages():array
    {
        return [
            'name.required' => 'Заполните поле',
            'name.regex' => 'Содержатся цифры или недостаочная длина'
        ];
    }
}
