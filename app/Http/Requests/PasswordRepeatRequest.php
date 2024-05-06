<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRepeatRequest extends FormRequest
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
            'password_repeat' => 'required|same:password'
        ];
    }

    public  function  messages():array
    {
        return [
            'password_repeat.required' => 'Заполните поле',
            'password_repeat.same' => 'Неверный пароль'
        ];

    }

}
