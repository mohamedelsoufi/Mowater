<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBrokerRequestRequest extends FormRequest
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
            'name_en' => 'unique:agencies,name_en',
            'name_ar' => 'unique:agencies,name_ar',
            'description_en' => 'required',
            'description_ar' => 'required',
            'requirements_en' => 'required',
            'requirements_ar' => 'required',
            'tax_number' => 'unique:brokers,tax_number',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'area_id' => 'required|exists:areas,id',
//            'year_founded' => 'nullable|numeric',
            'email' => 'required_without:id|email|unique:organization_users,email,' . $this->id,
            'password' => 'required_without:id',
            'user_name' => 'required_without:id',
        ];
    }


}
