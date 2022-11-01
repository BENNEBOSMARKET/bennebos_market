<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Seller\SellerRepository;
use Exception;


class SellerController extends Controller
{
    public function __construct(ApiResponse $apiResponse , SellerRepository $sellerRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->sellerRepository = $sellerRepository;

    }

    public function getCountSeller()
    {
        $countSeller = $this->sellerRepository->getCountSeller();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($countSeller)->getJsonResponse();
    }
    public function getInfoSeller()
    {

        try{
            $limit = request()->has('limit') ? request('limit') : 10;
        $infoSeller = $this->sellerRepository->getInfoSeller($limit);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($infoSeller)->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }
}
