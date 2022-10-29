<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\SendMoney\SendMoneyCustomerRepository;
use Illuminate\Http\Request;

class SendMoneyCustomerController extends Controller
{
    public function __construct(ApiResponse $apiResponse , SendMoneyCustomerRepository $sendMoneyCustomerRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->sendMoneyCustomerRepository = $sendMoneyCustomerRepository;

    }

    public function getCustomerPoint($id)
    {
        $photo = $this->sendMoneyCustomerRepository->getCustomerPoint($id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
    }
}
