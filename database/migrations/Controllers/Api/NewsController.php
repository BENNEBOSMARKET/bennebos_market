<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Repositories\HowBuyPage\HowBuyPageRepository;
use App\Repositories\News\NewsRepository;
use App\Repositories\Photo\PhotosRepository;
use App\Repositories\User\UserRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(ApiResponse $apiResponse , NewsRepository $newsRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->newsRepository = $newsRepository;

    }

    public function getAllNews()
    {
        $buyPage = $this->newsRepository->getAllNews();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($buyPage)->getJsonResponse();
    }
}
