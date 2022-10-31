<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryProdcut\CategoryProductCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\State;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeApiController extends Controller
{
    public function __construct(ApiResponse $apiResponse, UserRepositoryInterface $userRepository, Client $client)
    {
        $this->apiResponse = $apiResponse;
        $this->userRepository = $userRepository;
        $this->client = $client;
    }


    public function homeSliderAndBanner($type)
    {
        $slider = $this->userRepository->getSliderAndBanner($type);
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($slider)->getJsonResponse();
    }


    public function allCategory()
    {
        $category = $this->userRepository->getAllCategory();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($category)->getJsonResponse();
    }


    public function allBrands()
    {
        $brands = $this->userRepository->getAllBrands();
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($brands)->getJsonResponse();
    }


    public function productByType($type)
    {
        $product = DB::table('products')
            ->where('status', 1);

        if ($type == 'new') {
            $product = $product->orderBy('created_at', 'DESC')->take('3');
        } elseif ($type == 'top') {
            $product = $product->orderBy('created_at', 'ASC')->inRandomOrder()->take('3');
        } elseif ($type == 'protective') {
            $product = $product->orderBy('created_at', 'ASC')->take('3');
        } elseif ($type == 'drop' || $type == 'global' || $type == 'true_view') {
            $product = $product->inRandomOrder()->take('3');
        } elseif ($type == 'form_factories' || $type == 'top_ranking' || $type == 'first_dispatch' || $type == 'weekly_deals') {
            $product = $product->inRandomOrder()->take('3');
        } elseif ($type == 'all') {
            $product = $product->orderBy('created_at', 'DESC')->take('3');
        } elseif ($type == 'deals_of_the_day') {
            $product = $product->inRandomOrder()->take(4);
        }

        $product = $product->get();

        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($product)->getJsonResponse();
    }


    public function subCategoryTopThree()
    {
        $categories_data = Category::where('parent_id', '!=', 0)->where('sub_parent_id', 0)->take(5)->get();
        foreach ($categories_data as $key => $category) {
            $categories = [$category->id];

            $subcategories = DB::table('categories')->where('parent_id', $category->id)->pluck("id")->toArray();
            $categories = array_merge($categories, $subcategories);
            $subsubcategories = DB::table('categories')->whereIn('sub_parent_id', $categories)->pluck("id")->toArray();
            $categories = array_merge($categories, $subsubcategories);
            $categories_data[$key]->products = Product::leftJoin('brands', "products.brand_id", "brands.id")->whereIn('products.category_id', $categories)->where('products.status', 1)
                ->select(
                    "brands.id as brand_id",
                    "brands.name as brand_name",
                    "brands.logo as brand_banner",
                    "products.name as product_name",
                    "products.id as products_id",
                    "products.slug as product_slug",
                    "products.thumbnail as product_thumbnail",
                    "products.unit_price",
                    "products.discount_date_from",
                    "products.discount_date_to",
                    "products.discount",
                    "products.avg_review"
                )
                ->take(8)
                ->get();
                $categories_data[$key]->brands = Brand::whereIn("id", json_decode($category->brands))->get();
        }

        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($categories_data)->getJsonResponse();
    }

    public function search(Request $request)
    {
        try {
            $limit = $request->has("limit") ? $request->limit : 20;
            $tag = $request->has('tag') ? $request->tag : "";
            $products = Product::where("name", "LIKE", "%$tag%")->groupBy("main_product_id")->paginate($limit);
            return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(new CategoryProductCollection($products))->getJsonResponse();
        } catch (Exception $e) {
            return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData($e->getMessage())->getJsonResponse();
        }
    }

    public function getCountries()
    {
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(Country::all())->getJsonResponse();
    }

    public function getStates(Country $country)
    {
        return $this->apiResponse->setSuccess(__("Data retrieved successfully"))->setData(State::where("country_id", $country->id)->get())->getJsonResponse();
    }
}
