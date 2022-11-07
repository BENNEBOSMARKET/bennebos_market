<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Blogs\BlogRepository;
use App\Repositories\News\NewsRepository;
use Illuminate\Http\Request;

class BolgsController extends Controller
{
    public function __construct(ApiResponse $apiResponse , BlogRepository $blogRepository)
    {
        $this->apiResponse = $apiResponse;
        $this->blogRepository = $blogRepository;

    }

    public function getAllBlogs()
    {
        try {
            $limit = request()->has('limit') ? request('limit') : 10;
            $blog = $this->blogRepository->getAllBlogs($limit);
            return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($blog)->getJsonResponse();
        }
        catch( Exception $exception) {
            return $this->apiResponse->setError(
                $exception->getMessage() . " " . $exception->getLine() . " " . $exception->getFile()
            )->setData()->getJsonResponse();
        }

    }
}
