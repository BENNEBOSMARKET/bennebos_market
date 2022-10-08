<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Requests\WishListRequest;
use App\Http\Resources\WishList\WishListResource;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use App\Repositories\WishList\WishListRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function __construct(ApiResponse $apiResponse, WishListRepositoryInterface $wishListRepository, Client $client)
    {
        $this->apiResponse = $apiResponse;
        $this->wishListRepository = $wishListRepository;
        $this->client = $client;
    }


    public function addWishlist(WishListRequest $wishListRequest)
    {
        try{
            $response = $this->wishListRepository->addToWishList($wishListRequest);
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        return $this->apiResponse->setSuccess(__("Wishlist added successfully"))->setData(new WishListResource($response))->getJsonResponse();
    }


    public function getWishlist(WishListRequest $wishListRequest)
    {
        try {

            if ($wishListRequest->has('user_id')) {
                $response = $this->wishListRepository
                    ->model
                    ->with('product')
                    ->where("user_id", $wishListRequest->user_id)
                    ->get();

            } else {
                $response = $this->wishListRepository
                    ->model
                    ->with('product')
                    ->where("device_token", $wishListRequest->device_token)
                    ->get();
            }

            return $this->apiResponse->setSuccess(__("Wishlist fetched successfully"))
                ->setData(WishListResource::collection($response))
                ->getJsonResponse();

        } catch (Exception $exception) {
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }

    }


    public function updateWishList(WishListRequest $wishListRequest)
    {
        try{
            $response = $this->wishListRepository->updateWishList($wishListRequest);
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        if($response){
            return $this->apiResponse->setSuccess(__("Wishlist updated successfully"))->setData(new WishListResource($response))->getJsonResponse();
        }else{
            return $this->apiResponse->setError("product does not exist")->setData()->getJsonResponse();
        }
    }


    public function deleteWishList(WishListRequest $wishListRequest)
    {
        try{
            $this->wishListRepository->deleteWishList($wishListRequest);
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        return $this->apiResponse->setSuccess(__("Wishlist deleted successfully"))->setData()->getJsonResponse();
    }
    public function deleteWishListProduct(WishListRequest $wishListRequest)
    {
        try{
            $this->wishListRepository->deleteWishListProduct($wishListRequest);
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        return $this->apiResponse->setSuccess(__("Wishlist product deleted successfully"))->setData()->getJsonResponse();
    }

    public function assignUserToWishlist(WishListRequest $wishListRequest){
        try{
            $this->wishListRepository->assignUser($wishListRequest->device_token);
        }catch(Exception $exception){
            return $this->apiResponse->setError($exception->getMessage())->setData()->getJsonResponse();
        }
        return $this->apiResponse->setSuccess(__("user assigned successfully"))->setData()->getJsonResponse();

    }
}
