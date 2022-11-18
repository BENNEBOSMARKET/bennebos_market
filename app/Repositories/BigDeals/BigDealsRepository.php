<?php
namespace App\Repositories\BigDeals;


use App\Models\BigDealsProduct;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\MiddleBanner;
use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BigDealsRepository extends BaseRepository
{
    public $photo;

    public function __construct(BigDealsProduct $bigDealsProduct)
    {
        $this->bigDealsProduct = $bigDealsProduct;
    }


    public function getBigDealsProduct()
    {
        return DB::table('big_deals_products')->take(12)->orderBy('created_at','desc')->get();
    }
}
