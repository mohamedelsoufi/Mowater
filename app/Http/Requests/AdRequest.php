<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class AdRequest extends FormRequest
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
     * use Illuminate\Support\Facades\Validator;
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'title_en' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
//            'description_en' => 'required',
//            'price' => 'required',
            'negotiable' => 'required',
//            'country_id' => 'required|exists:countries,id',
//            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
//            'car_models' => 'required|array',
//            'manufacturing_years' => 'required|array'
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
