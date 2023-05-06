<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'code' => 'required|min:2|unique:categories,code'
        ];
        if($this->route()->named('categories.update')){
            $rules['code'] .= ',' . $this->route()->parameter('category'); //id категории для которой не нужно делать проверку на уникальность
        };


        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле обязательне к заполнению',
            'code.unique' => 'Категория уже существует',
            'min' => 'Слишком короткое сообщение, минимум символов :min'
        ];
    }
}
