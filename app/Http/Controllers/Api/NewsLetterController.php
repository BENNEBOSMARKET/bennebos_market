<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsLetterRequest;

use App\Repositories\News\NewsLetterRepository;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{

    public function __construct(ApiResponse $apiResponse , NewsLetterRepository $newsLetterRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->newsLetterRepository = $newsLetterRepository;


    }

//    public function getAllPhotos()
//    {
//        $photo = $this->photosRepository->getAllPhoto();
//        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($photo)->getJsonResponse();
//    }
    public function postNewsLetter(NewsLetterRequest $newsLetterRequest)
    {
        $newsLetter = $this->newsLetterRepository->postNewsLetter($newsLetterRequest);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData( $newsLetter)->getJsonResponse();
    }
}
