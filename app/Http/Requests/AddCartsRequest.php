<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddCartsRequest extends FormRequest
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
            'owner_id'      => 'required|array',
            'user_id'       => 'nullable|array',
            'user_id.*'     => 'exists:users,id',
            'product_id'    => 'required|array',
            'product_id.*'  => 'exists:products,id',
            'address_id'    => 'nullable|array',
            'price'         => 'required|array',
            'tax'           => 'required|array',
            'shipping_cost' => 'required|array',
            'discount'      => 'required|array',
            'coupon_code'   => 'nullable|array',
            'quantity'      => 'required|array',
            'color'         => 'nullable|array',
            'size'          => 'nullable|array',
            'ip_address'    => 'required',
            'status'        => 'nullable'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => null
                ],
                400
            )
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => "Error: you are not authorized or do not have the permission",
                    'data' => null
                ],
                400
            )
        );
    }
}
