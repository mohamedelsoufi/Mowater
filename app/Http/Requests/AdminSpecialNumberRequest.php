<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSpecialNumberRequest extends FormRequest
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
            'special_number_category_id' => 'exists:special_number_categories,id',
            'number' => 'unique:special_numbers,number,'.$this->id,
            'size' => 'in:normal_plate,special_plate',
            'transfer_type' => 'in:waiver,own',
            'price' => 'numeric|between:0,999999999999999.99',
//            'Include_insurance' => 'boolean',
            'special_number_organization_id ' => 'nullable|exists:special_number_organizations,id',
        ];
    }

    public function withValidator($validator)
    {
        if($validator->fails()){
            $validator->after(function ($validator) {
                if ($this->id != null) {
                    $validator->errors()->add('update_modal', $this->id);
                }
            });
        }
    }
}
