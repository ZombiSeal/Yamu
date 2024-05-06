<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required|min:6'
        ];
    }

    public  function  messages():array
    {
        return [
            'password.required' => 'Заполните поле',
            'password.min' => 'Ненадежгый пароль(минимум 6 символов)'
        ];

    }
}
