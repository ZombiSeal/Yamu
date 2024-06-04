<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|min:2',
            'description' => 'required|min:2',
            'weight' => 'required',
            'price' => 'required',
            'protein' => 'required',
            'fats' => 'required',
            'carbs' => 'required',
            'calories' => 'required',

        ];
    }

    public  function  messages():array
    {
        return [
            'required' => 'Заполните поле',
            'min' => 'Недостаточная длина'
        ];
    }
}
