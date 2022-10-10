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
}
