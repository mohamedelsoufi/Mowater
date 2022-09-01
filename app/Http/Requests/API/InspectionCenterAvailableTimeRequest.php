<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class InspectionCenterAvailableTimeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:technical_inspection_centers,id',
            'service' => 'required|exists:technical_inspection_center_services,id',
            'date'=>'required|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = responseJson(0,'error',$validator->errors());
        throw new ValidationException($validator,$response);
    }
}
