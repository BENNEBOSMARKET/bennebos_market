<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ContactUs\ContactUsRepository;
use App\Repositories\HelpCenter\HelpCenterPageRepositories;
use Illuminate\Http\Request;

class ContacUsPageController extends Controller
{
    public function __construct(ApiResponse $apiResponse , ContactUsRepository $contactUsRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->contactUsRepository = $contactUsRepository;

    }

    public function getAllContactUsPage()
    {
        $contactUs = $this->contactUsRepository->getAllContactUsPage();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($contactUs)->getJsonResponse();
    }
}
