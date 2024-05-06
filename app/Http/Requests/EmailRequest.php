<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'email' => 'required|regex:/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}/|unique:users,email',
        ];
    }

    public  function  messages():array
    {
        return [
            'email.required' => 'Заполните поле',
            'email.regex' => 'Неверный формат e-mail',
            'email.unique' => 'Пользователь с e-mail уже существует'
        ];
    }
}
