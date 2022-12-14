<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminTrainerRequest extends FormRequest
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
//            'name_en' => 'required',
            'name_ar' => 'required',
//            'manufacturing_year' => 'required',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
//            'car_class_id' => 'required|exists:car_classes,id',
//            'brand_id' => 'required|exists:brands,id',
//            'car_model_id' => 'required|exists:car_models,id',
            'email' => 'required|email|unique:organization_users,email',
            'password' => 'required',
            'user_name' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            $validator->after(function ($validator) {
                if ($this->id != null) {
                    $validator->errors()->add('update_modal', $this->id);
                }
            });
        }
    }
}
