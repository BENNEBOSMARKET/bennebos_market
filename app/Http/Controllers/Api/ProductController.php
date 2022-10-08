<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryProdcut\CategoryProductCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Exception;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct( ApiResponse $apiResponse, ProductRepositoryInterface $repository, CategoryRepositoryInterface $categoryRepository, Review $reviewModel)
    {
        $this->apiResponse = $apiResponse;
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->reviewModel = $reviewModel;
    }

    public function getProducts(Request $request){

        try {

            $products = $this->repository->model
            ->withCount('wishlists')
            ->where('status',1)
            ->paginate($request->limit);

            return $this->apiResponse->setSuccess("products_listed_successfully")
                ->setData(new CategoryProductCollection($products))
                ->getJsonResponse();

        } catch(Exception $exception) {
            return $this->apiResponse->setSuccess($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getSingleProduct($product_id){
        try {

            $product = $this->repository->getSingleProduct($product_id);
            return $this->apiResponse->setSuccess("product_loaded_successfully")
                ->setData(new ProductResource($product))
                ->getJsonResponse();

        } catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }

    public function getProductByColorAndSize($productId)
    {
        $sizeId = request('size_id',null);
        $colorId = request('color_id',null);
        $product = $this->repository->productBySizeOrColor($productId,$sizeId ,$colorId);

        return $this->apiResponse->setSuccess("product_loaded_successfully")
            ->setData(new ProductResource($product))
            ->getJsonResponse();

    }

    public function getDiscountProducts(Request $request){
        try{
            $products = $this->repository->getDiscountProducts($request->limit);
        return $this->apiResponse->setSuccess("products_with_discount_loaded_successfully")->setData(new ProductCollection($products))->getJsonResponse();
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }
    public function getCategoryProducts(Request $request, $category_id){
        try {

            $category = $this->categoryRepository->find($category_id);
            $limit = $request->limit? $request->limit : 10;
            if($category) {
                $products = $this->repository->getCategoryProducts($category_id,$limit);

                return $this->apiResponse->setSuccess("Category_products_loaded_successfully")
                    ->setData(new CategoryProductCollection($products))
                    ->getJsonResponse();
            } else {
                return $this->apiResponse->setError("Category_does_not_exist")->setData()->getJsonResponse();
            }
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }

    }
    public function getRelatedProducts(Request $request, $category_id, $product_id){
        try{
            $category = $this->categoryRepository->find($category_id);
            $limit = $request->limit? $request->limit : 10;
            if($category){
                $products = $category->products()
                    ->withCount('wishlists')
                    //->translate()
                    //->selectAll()
                    ->where('products.id',"!=",$product_id)
                    ->paginate($limit);

                return $this->apiResponse
                    ->setSuccess("Category_products_loaded_successfully")
                    ->setData(new CategoryProductCollection($products))
                    ->getJsonResponse();

            }else{
                return $this->apiResponse->setError("Category_or_products_does_not_exist")->setData()->getJsonResponse();
            }
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }

    }
    public function makeReview(ProductRequest $productRequest){
        DB::beginTransaction();
        try{
            $user_id = Auth::id();
            $review = $this->reviewModel->create(array_merge(['user_id' => $user_id],$productRequest->validated()));
            $product = $this->repository->model->find($productRequest->product_id);
            $product->increment('total_review');
            $rate_avg = $this->reviewModel->where('product_id',$productRequest->product_id)->avg('rating');
            $product->update(['avg_review' => $rate_avg]);
            $product->refresh();
            DB::commit();
            return $this->apiResponse->setSuccess("User_Updated_Successfully")->setData(new ReviewResource($review))->getJsonResponse();
        }catch(Exception $exception){
            DB::rollback();
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
    }


    public function productByCategorySlug($slug, ProductRequest $productRequest)
    {
        try{
            $category = $this->repository->productByCategorySlug($slug, $productRequest);
            if($category){
                return $this->apiResponse->setSuccess("Category_products_loaded_successfully")->setData(new ProductCollection($category))->getJsonResponse();
            }else{
                return $this->apiResponse->setError("Category_does_not_exist")->setData()->getJsonResponse();
            }
        }catch(Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }
    public function statisticsProducts(){
        try{
            $limit = request()->has('limit') ? request('limit') : 8;
            $products_data = $this->repository->getSomeStatisitcsProducts($limit);
            return $this->apiResponse->setSuccess("proucts_statistics_loaded_successfully")->setData($products_data)->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }
    public function filter(Request $request){
        try{
            $limit = $request->has('limit') ? $request->limit : 20;
            $filter_queries = $request->query();
            $products = $this->repository->filterProducts($filter_queries, $limit);
            return $this->apiResponse->setSuccess("Filtered Products Loaded Successfully")->setData(new CategoryProductCollection($products))->getJsonResponse();
        }catch( Exception $exception){
            return $this->apiResponse->setError(
                $exception->getMessage(). " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }
    }

}
