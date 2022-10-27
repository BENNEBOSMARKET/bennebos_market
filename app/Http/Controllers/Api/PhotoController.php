<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Photo;
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

    public function getAllPhotos()
    {
        $photo = $this->photosRepository->getAllPhoto();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
    }
}
