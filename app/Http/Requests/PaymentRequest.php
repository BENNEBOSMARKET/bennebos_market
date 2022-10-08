<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentRequest extends FormRequest
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
            "conversation_id" => "required|numeric",
            "price" => "required|numeric",
            "paid_price" => "required|numeric",
            "order_id" => "required|integer|exists:orders,id",
            "card_holder_name" => "nullable|string|min:2",
            "card_number" => "nullable|numeric",
            "expire_month" => "nullable|numeric",
            "expire_year" => "nullable|numeric",
            "card_csv" => "nullable|numeric",
            "save_card" => "nullable|in:0,1",
            "buyer_id" => "required|integer|exists:users,id",
            "buyer_first_name" => "required|string|min:2",
            "buyer_last_name" => "required|string|min:2",
            "buyer_phone" => "required|numeric",
            "buyer_email" => "required|email",
            "buyer_identity_number" => "required|numeric",
            "buyer_address" => "required|string",
            "buyer_ip" => "required|ip",
            "buyer_city" => "required|string",
            "buyer_country" => "required|string",
            "shipping_contact_name" => "required|string|min:2",
            "shipping_city" => "required|string|min:2",
            "shipping_country" => "required|string|min:2",
            "shipping_address" => "required|string|min:2",
            "billing_contact_name" => "required|string|min:2",
            "billing_city" => "required|string|min:2",
            "billing_country" => "required|string|min:2",
            "billing_address" => "required|string|min:2",
            "basket_items" => "required|array",
            "basket_items.*.id" => "required|integer|exists:products,id",
            "basket_items.*.name" => "required|string|min:2",
            "basket_items.*.category" => "required|string|min:2",                                                              
            "basket_items.*.price" => "required|numeric",                                                                
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
