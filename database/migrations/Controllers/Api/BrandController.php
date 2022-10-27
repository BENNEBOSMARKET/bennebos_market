<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Repositories\Brand\BrandRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(ApiResponse $apiResponse, BrandRepositoryInterface $repository)
    {
        $this->apiResponse = $apiResponse;
        $this->repository = $repository;
    }

    public function getBrands(Request $request){
        try{
            $limit = $request->has("limit") ? $request->limit : 20;
            $brands = $this->repository->model->where('status', "1")->paginate($limit);
            return $this->apiResponse->setSuccess("Brands data listed successfully")->setData(new BrandCollection($brands))->getJsonResponse();
        }catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getBrandProducts(Request $request, $brand_id){
        try{
            $limit = $request->limit? $request->limit : 10;
            $brand = $this->repository->find($brand_id);
            if($brand){
                $products = $brand->products()->where("status", '1')->paginate($limit);
                return $this->apiResponse->setSuccess("Brands data listed successfully")->setData(new ProductCollection($products))->getJsonResponse();
            }else{
                return $this->apiResponse->setError("Brand_does_not_exist")->setData()->getJsonResponse();
            }
        }catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }
}
