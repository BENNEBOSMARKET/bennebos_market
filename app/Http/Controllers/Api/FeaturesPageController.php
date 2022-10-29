<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\FeaturesPage\FeaturesPageRepository;
use App\Repositories\HowBuyPage\HowBuyPageRepository;
use Illuminate\Http\Request;

class FeaturesPageController extends Controller
{
    public function __construct(ApiResponse $apiResponse , FeaturesPageRepository $featuresPageRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->featuresPageRepository = $featuresPageRepository;

    }

    public function getAllFeatures()
    {
        $featuresPage = $this->featuresPageRepository->getAllFeatures();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($featuresPage)->getJsonResponse();
    }
}
