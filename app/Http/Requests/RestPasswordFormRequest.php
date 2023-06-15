<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestPasswordFormRequest extends FormRequest
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
            'email' => 'required|email|exists:users'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Це поле обовʼязково заповнювати',
            'email' => 'Це не схоже на поштову адресу',
            'exists' => 'Ця пошта не зареєстрована у нашому магазині'
        ];
    }
}
