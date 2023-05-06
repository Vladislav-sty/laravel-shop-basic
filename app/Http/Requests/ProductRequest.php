<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:2',
            'code' => 'required|min:2',
            'description' => 'required|min:2',
            'category_id' => 'required',
        ];

        return $rules;
    }

    public function messages(){
        return [
            'category_id.required' => 'Нужно обязательно выбрать категорию',
            'required' => 'Поле обязательное к заполнению',
            'min' => 'Мало символов, минимум :min',
        ];
    }
}
