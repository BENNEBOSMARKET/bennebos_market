<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\MiddleBanner\MiddleBannerRepository;
use Illuminate\Http\Request;

class AllMiddleBannerController extends Controller
{
    public function __construct(ApiResponse $apiResponse , MiddleBannerRepository $middleBannerRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->middleBannerRepository = $middleBannerRepository;

    }




    public function getMiddleBannerPhoto()
    {
        $middleBanner = $this->middleBannerRepository->getMiddleBannerPhoto();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($middleBanner)->getJsonResponse();
    }
}
