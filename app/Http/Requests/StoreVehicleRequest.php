<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'plate_number' => 'string|required|unique:vehicles',
            'body_type' => 'required',
            'make' => 'required',
            'year_model' => 'required',
            'color' => 'required',
            'engine_number' => 'required',
            'chassis_number' => 'required',
            'lto_cc_number' => 'required',
            'or_number' => 'required',
            'cr_number' => 'required',
            //'requirements' => 'required',
        ];
    }
}
