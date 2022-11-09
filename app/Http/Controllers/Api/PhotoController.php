<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Photos\PhotosResource;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use App\Repositories\Photo\PhotosRepository;
use App\Repositories\User\UserRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct(ApiResponse $apiResponse , PhotosRepository $photosRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->photosRepository = $photosRepository;

    }

//    public function getAllPhotos()
//    {
//        $photo = $this->photosRepository->getAllPhoto();
//        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
//    }
    public function getCategoryPhoto($id)
    {
        $photo = $this->photosRepository->getCategoryPhoto($id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData( PhotosResource::collection($photo))->getJsonResponse();
    }

    public function getSliderRightProductPhoto($id)
    {
        $photo = $this->photosRepository->getSliderRightProductPhoto($id);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
    }

    public function getHomePhoto()
    {
        $photo = $this->photosRepository->getHomePhoto();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(PhotosResource::collection($photo))->getJsonResponse();
    }
}
