<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RegisterAccountRequest extends FormRequest
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
            'name' => 'string|required', 
            'birthday' => 'string|required',
            'gender' => 'string|required',
            'email' => 'string|required|unique:users|email',
            'mobile_number' => 'required|unique:users|numeric',
            'password' => 'string|min:8|confirmed'
        ];
    }
}
