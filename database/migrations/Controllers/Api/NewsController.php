<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepository;
use App\Repositories\Photo\PhotosRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(ApiResponse $apiResponse , NewsRepository $newsRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->newsRepository = $newsRepository;

    }

    public function getAllPhotos()
    {
        $news = $this->newsRepository->getAllNews();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($news)->getJsonResponse();
    }
}
