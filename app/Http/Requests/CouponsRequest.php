<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponsRequest extends FormRequest
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
        return [
            'code' => 'required|max:15',
            'value' => 'required',
            'currency_id' => 'required_with:type'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Це поле обовʼязкове',
            'max' => 'Максимальна кількість символів :max',
            'required_with' => 'Це поле обовʼязкове'
        ];
    }
}
