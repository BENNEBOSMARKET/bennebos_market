<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\HowBuyPage\HowBuyPageRepository;


class HowBuyPageController extends Controller
{
    public function __construct(ApiResponse $apiResponse , HowBuyPageRepository $buyPageRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->buyPageRepository = $buyPageRepository;

    }

    public function getAllHowBuyPage()
    {
        $buyPage = $this->buyPageRepository->getAllHowBuyPage();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($buyPage)->getJsonResponse();
    }
}
