<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LastnameRequest extends FormRequest
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
            'lastname' => 'required|regex:/^([A-Za-zА-Яа-я-]{2,})$/u',
        ];
    }

    public  function  messages():array
    {
        return [
            'lastname.required' => 'Заполните поле',
            'lastname.regex' => 'Содержатся цифры или недостаочная длина'
        ];
    }
}
