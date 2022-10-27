<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsUpload extends Controller
{
    public function __construct(ApiResponse $apiResponse, ProductRepositoryInterface $repository)
    {
        $this->apiResponse = $apiResponse;
        $this->repository = $repository;
    }

    public function productsUpload(Request $request){
        $validation = Validator::make($request->all(),[
            'file' => "required|max:4096"
        ],[]);

        if($validation->errors()->first()){
            return $this->apiResponse->setError($validation->errors()->first())->setData()->getJsonResponse();
        }
        try{
            DB::beginTransaction();
            $productsData = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',file_get_contents($request->file('file'))),true,512,JSON_INVALID_UTF8_IGNORE);
            $this->repository->addProductsSellers($productsData['sellers']);
            $this->repository->addProducts($productsData['products']);
        }catch(Exception $exception){
            DB::rollBack();
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        DB::commit();
        return $this->apiResponse->setSuccess("data has been added successfully")->setData()->getJsonResponse();
        

    }

}
