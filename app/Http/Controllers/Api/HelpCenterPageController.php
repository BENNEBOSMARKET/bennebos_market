<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\FeaturesPage\FeaturesPageRepository;
;

use App\Repositories\HelpCenter\HelpCenterPageRepositories;
use Illuminate\Http\Request;

class HelpCenterPageController extends Controller
{
    public function __construct(ApiResponse $apiResponse , HelpCenterPageRepositories $helpCenterPageRepositories)
    {
        $this->apiResponse = $apiResponse;
        $this->helpCenterPageRepositories = $helpCenterPageRepositories;

    }

    public function getAllHelp()
    {
        $helpCenter = $this->helpCenterPageRepositories->getAllHelp();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($helpCenter)->getJsonResponse();
    }
}
