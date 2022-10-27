<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\SendMoney\SendMoneyCustomerRepository;
use Illuminate\Http\Request;

class SendMoneyCustomerController extends Controller
{
    public function __construct(ApiResponse $apiResponse , SendMoneyCustomerRepository $sendMoneyCustomerRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->sendMoneyCustomerRepository = $sendMoneyCustomerRepository;

    }

    public function getAllSendMoneyCustomer()
    {
        $photo = $this->sendMoneyCustomerRepository->getAllSendMoneyCustomer();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
    }
}
