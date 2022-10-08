<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Http\Requests\AddCartsRequest;
use App\Http\Requests\RemoveCartRequest;
use App\Http\Requests\RemoveProductRequest;
use App\Http\Resources\Cart\CartCollection;
use App\Http\Resources\Cart\CartResource;
use App\Repositories\Cart\CartRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(ApiResponse $apiResponse, CartRepositoryInterface $cartRepository, Client $client)
    {
        $this->apiResponse = $apiResponse;
        $this->cartRepository = $cartRepository;
        $this->client = $client;
    }


    public function addCart(AddCartRequest $addCartRequest)
    {
        $cartData = $this->cartRepository->addToCart($addCartRequest);

        if ($cartData)
            return $this->apiResponse->setSuccess(__("Cart added successfully"))->setData(new CartResource($cartData))->getJsonResponse();
        else
            return $this->apiResponse->setError('Something went wrong')->setData()->getJsonResponse();
    }


    public function addCarts(AddCartsRequest $addCartsRequest)
    {
        $cartData = $this->cartRepository->addToCarts($addCartsRequest);

        if ($cartData)
            return $this->apiResponse->setSuccess(__("Cart added successfully"))->setData(new CartCollection($cartData))->getJsonResponse();
        else
            return $this->apiResponse->setError('Something went wrong')->setData()->getJsonResponse();
    }


    public function removeCart(RemoveCartRequest $removeCartRequest)
    {
        $this->cartRepository->removeCart($removeCartRequest);

        return $this->apiResponse->setSuccess(__("Cart removed successfully"))->setData()->getJsonResponse();
    }


    public function removeProduct(RemoveProductRequest $removeProductRequest)
    {
        $this->cartRepository->removeProduct($removeProductRequest);

        return $this->apiResponse->setSuccess(__("Product(s) removed successfully"))->setData()->getJsonResponse();
    }


    public function addUserToCart(Request $request)
    {
        $response = $this->cartRepository->addUserToCart($request);

        return $this->apiResponse->setSuccess(__("User added to cart successfully"))->setData(new CartResource($response))->getJsonResponse();
    }


    public function getCartByUserId(Request $request)
    {
        $response = $this->cartRepository->getCartByUser($request);

        return $this->apiResponse->setSuccess(__("Cart retrieved successfully"))->setData(new CartCollection($response))->getJsonResponse();
    }
}
