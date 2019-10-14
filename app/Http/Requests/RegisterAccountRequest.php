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
            'first_name' => 'string|required', 
            'last_name' => 'string|required', 
            'middle_name' => 'string|required', 
            'birthday' => 'string|required', 
            'tin_number' => 'string|required',
            'address' => 'string|required',
            'gender' => 'string|required',
            'email' => 'string|required|unique:users|email',
            'mobile_number' => 'required|unique:users|numeric',
            'password' => 'string|min:8|confirmed'
        ];
    }
}
