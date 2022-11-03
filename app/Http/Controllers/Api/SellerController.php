<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Resources\Seller\SellerResource;
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
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData( SellerResource::collection($countSeller))->getJsonResponse();
    }
    public function getInfoSeller()
    {

        try{
            $id = request()->has('id')?request('id'):0;
            $limit = request()->has('limit') ? request('limit') : 10;
        $infoSeller = $this->sellerRepository->getInfoSeller($limit,$id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($infoSeller)->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }
}
