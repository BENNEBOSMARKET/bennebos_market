<?php
namespace App\Repositories\Seller;

use App\Models\Country;
use App\Models\HowBuyPage;
use App\Models\Seller;
use App\Models\Shop;
use App\Repositories\Base\BaseRepository;


use Illuminate\Support\Facades\DB;


class  SellerRepository extends BaseRepository
{
    public $seller;
    public $shop;
    public function __construct(Seller $seller ,Shop $shop)
    {
        $this->seller=$seller;
        $this->shop=$shop;
    }

    public function getInfoSeller($limit){
           $sellers= DB::table('sellers')->leftJoin('shops','sellers.id','=','shops.seller_id')


            ->select('sellers.id','sellers.email','sellers.phone',
            'shops.address','shops.logo','shops.name','shops.facebook','shops.twitter','shops.google','shops.youtube')
               ->orderBy('id', 'DESC')->paginate($limit);
        return $sellers;

    }


}
