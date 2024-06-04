<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'city' => 'required|min:2',
            'street' => 'required|min:2',
            'house' => 'required',
        ];
    }

    public  function  messages():array
    {
        return [
            'required' => 'Заполните поле'
        ];
    }
}
