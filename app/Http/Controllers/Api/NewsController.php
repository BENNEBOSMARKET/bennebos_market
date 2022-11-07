<?php

namespace App\Http\Controllers\Api;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepository;


class NewsController extends Controller
{
    public function __construct(ApiResponse $apiResponse , NewsRepository $newsRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->newsRepository = $newsRepository;

    }

    public function getNews()
    {
        try {

                $limit = request()->has('limit') ? request('limit') : 10;
                $newsRepository = $this->newsRepository->getAllNews($limit);
                return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($newsRepository)->getJsonResponse();
                 }
                 catch( Exception $exception) {
                return $this->apiResponse->setError(
                    $exception->getMessage() . " " . $exception->getLine() . " " . $exception->getFile()
                )->setData()->getJsonResponse();
        }

    }
}
