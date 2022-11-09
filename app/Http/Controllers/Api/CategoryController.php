<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\HeaderCategoryResource;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct( ApiResponse $apiResponse, CategoryRepositoryInterface $repository ,CategoryRepository $categoryRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->repository = $repository;
        $this->categoryRepository=$categoryRepository;
    }
    public function getCategories(){
        try{
            $categories = $this->repository->parentCategories();
            return $this->apiResponse->setSuccess("Categories data listed successfully")->setData(new CategoryCollection($categories))->getJsonResponse();
        }catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getMainCategories(){
        try{
            $categories = $this->repository->parentCategories();
            return $this->apiResponse->setSuccess("Categories data listed successfully")->setData($categories)->getJsonResponse();
        }catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getSubCategories(Request $request, $category_id){
        try{
            $limit = $request->has('limit')? $request->limit : 20;
            $sub_cateogirs = $this->repository->subCategories($category_id, $limit);
            return $this->apiResponse->setSuccess("Sub Categories data listed successfully")->setData($sub_cateogirs)->getJsonResponse();
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getSubSubCategories(Request $request, $category_id){
        try{
            $limit = $request->has('limit')? $request->limit : 20;
            $sub_sub_cateogirs = $this->repository->subSubCategories($category_id, $limit);
            return $this->apiResponse->setSuccess("Sub Categories data listed successfully")->setData($sub_sub_cateogirs)->getJsonResponse();
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getSingleCategory($category_id){
        try{

            $category = $this->repository->model->find($category_id);
            if (is_null($category)) {
                return $this->apiResponse->setError(__('category_not_found'))
                    ->setData()
                    ->getJsonResponse();
            }

            return $this->apiResponse->setSuccess("Category data listed successfully")
                ->setData(new CategoryResource($category))
                ->getJsonResponse();

        }catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }
    public function categoryStatistics($category_id){
        try{
            $limit = request()->has('limit') ? request('limit') : 8;
            $products_data = $this->repository->getSomeCategoryStatisitcs($limit,$category_id);
            return $this->apiResponse->setSuccess("proucts_statistics_loaded_successfully")->setData($products_data)->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }

    public function getAllHeaderCategory()
    {
        $countSeller = $this->categoryRepository->getAllHeaderCategory();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(HeaderCategoryResource::collection($countSeller))->getJsonResponse();
    }

    public function getAllHeaderSubCategory($id)
    {
        $countSeller = $this->categoryRepository->getAllHeaderSubCategory($id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(HeaderCategoryResource::collection($countSeller))->getJsonResponse();
    }

}
