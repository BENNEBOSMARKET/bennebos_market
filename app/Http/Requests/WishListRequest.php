<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class WishListRequest extends FormRequest
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
        if(str_contains($this->path(),"wishlist/assign")){
            return [
                'device_token' => 'required|string',
            ];
        }
        if(str_contains($this->path(),"wishlist/delete")){
            return [
                'device_token' => 'required|string',
                'user_id' => 'nullable|integer|exists:users,id',
            ];
        }
        if(str_contains($this->path(),"wishlist/delete/product")){
            return [
                'product_id'   => 'required|integer|exists:products,id',
                'device_token' => 'required|string',
                'user_id' => 'sometimes|nullable|integer|exists:users,id',
            ];
        }
        if(str_contains($this->path(),"wishlist/get")){
            return [
                'device_token' => 'required|string',
                'user_id' => 'sometimes|nullable|integer|exists:users,id',
            ];
        }
        return [
            'product_id'   => 'required|integer|exists:products,id',
            'device_token' => 'required|string',
            'user_id'      => 'nullable|exists:users,id',
            'heart'        => 'nullable|integer',
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
