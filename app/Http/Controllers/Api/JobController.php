<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Job\JobRepository;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(ApiResponse $apiResponse , JobRepository $jobRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->jobRepository = $jobRepository;

    }




    public function getJobList()
    {
        $JobList = $this->jobRepository->getJobList();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($JobList)->getJsonResponse();
    }
}
