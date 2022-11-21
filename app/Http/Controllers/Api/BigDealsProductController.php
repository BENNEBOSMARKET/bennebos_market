<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BigDeals\BigDealsResource;
use App\Repositories\BigDeals\BigDealsRepository;
use Illuminate\Http\Request;

class BigDealsProductController extends Controller
{
    public function __construct(ApiResponse $apiResponse , BigDealsRepository $bigDealsRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->bigDealsRepository = $bigDealsRepository;

    }




    public function getBigDealsProduct()
    {
        try{
            $id = request()->has('id')?request('id'):0;
            $limit = request()->has('limit') ? request('limit') : 10;
            $bigDeals = $this->bigDealsRepository->getBigDealsProduct($limit,$id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(BigDealsResource::collection($bigDeals))->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }
}
