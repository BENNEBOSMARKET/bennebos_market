<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\HelpCenter\HelpCenterPageRepositories;
use App\Repositories\OurService\OurServiceRepository;
use Illuminate\Http\Request;

class OurServicePageController extends Controller
{
    public function __construct(ApiResponse $apiResponse , OurServiceRepository $ourServiceRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->ourServiceRepository = $ourServiceRepository;

    }

    public function getAllServices()
    {
        $ourService = $this->ourServiceRepository->getAllServices();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($ourService)->getJsonResponse();
    }
}
