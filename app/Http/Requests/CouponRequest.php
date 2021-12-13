<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'valid_from' => 'required|before:valid_until|date|date_format:Y-m-d',
            'valid_until' => 'required|after:valid_from|date|date_format:Y-m-d',
            'amount' => 'required|integer|gt:0',
            'max_redeem' => 'required|gte:max_redeem_per_user|integer|gt:0',
            'max_redeem_per_user' => 'required|lte:max_redeem|integer|gt:0',
        ];
    }
}
