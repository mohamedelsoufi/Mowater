<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AddBidRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'auction_id' => 'required|exists:auctions,id',
            'bid_amount' => 'required|between:0,99999999999999.99'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = responseJson(0,'error',$validator->errors());
        throw new ValidationException($validator,$response);
    }
}
