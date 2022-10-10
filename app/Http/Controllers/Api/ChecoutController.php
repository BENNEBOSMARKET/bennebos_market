<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChecoutController extends Controller
{
    //
    public function __construct(ApiResponse $apiResponse, Address $addressModel)
    {
        $this->apiResponse = $apiResponse;
        $this->addressModel = $addressModel;
    }

    public function getAddresses()
    {
        $addresses = $this->addressModel->where('user_id', Auth::id())->get();
        return $this->apiResponse->setSuccess("Addresses Has been loaded successfully")->setData($addresses)->getJsonResponse();
    }
    public function createAddresses(Request $request)
    {
        $rules = [
            "first_name" => "required|string|min:2",
            "last_name" => "required|string|min:2",
            "address" => "required|string|min:2",
            "country" => "required|string|min:2",
            "state" => "required|string|min:2",
            "email" => "required|email|min:2",
            "phone" => "required|string|min:2",
            "post_code" => "required|string|min:2",
        ];
        
        $validations = Validator::make($request->all(), $rules);
        
        if ($validations->errors()->first()) {
            return $this->apiResponse->setError($validations->errors()->first())->setData()->getJsonResponse();
        }
        $data = array_merge($validations->validated(), ["user_id" => Auth::id()]);
        
        $address = $this->addressModel->create($data);
        return $this->apiResponse->setSuccess("Address Has been added successfully")->setData($address)->getJsonResponse();

    }
    
    public function updateAddress(Request $request){
        $rules = [
            "address_id" => "required|integer|min:1|exists:addresses,id",
            "first_name" => "nullable|string|min:2",
            "last_name" => "nullable|string|min:2",
            "address" => "nullable|string|min:2",
            "country" => "nullable|string|min:2",
            "state" => "nullable|string|min:2",
            "email" => "nullable|email|min:2",
            "phone" => "nullable|string|min:2",
            "post_code" => "nullable|string|min:2",
        ];
        
        $validations = Validator::make($request->all(), $rules);
        
        if ($validations->errors()->first()) {
            return $this->apiResponse->setError($validations->errors()->first())->setData()->getJsonResponse();
        }
        $data = $validations->validated();
        $address = $this->addressModel->find($data['address_id']);
        $address->update($data);
        return $this->apiResponse->setSuccess("Address Has been updated successfully")->setData($address)->getJsonResponse();
    }

    public function deleteAddress(Address $address){
        $address->delete();
        return $this->apiResponse->setSuccess("Address Has been deleted successfully")->setData($address)->getJsonResponse();

    }
}
