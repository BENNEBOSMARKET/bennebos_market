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


    public function getBigDealsProduct($limit,$id)
    {
        if ($id ==0){
            return DB::table('big_deals_products')->where('best_big_deal',1)->take(12)->orderBy('created_at','desc')->paginate($limit);

        }
        else{
            return DB::table('big_deals_products')->where('category_id',$id)->where('best_big_deal',1)->take(12)->orderBy('created_at','desc')->paginate($limit);

        }
    }
}
