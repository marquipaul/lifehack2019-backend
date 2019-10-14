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
            'series' => 'required',
            'year_model' => 'required',
            'color' => 'required',
            'engine_number' => 'required',
            'chassis_number' => 'required',
            'me_control_number' => 'required',
            'classification' => 'required',
            'lto_cc_number' => 'required',
            'mv_file_number' => 'required',
            'mvrr_number' => 'required',
            'cr_number' => 'required',
        ];
    }
}
