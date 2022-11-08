<?php
namespace App\Repositories\MiddleBanner;


use App\Models\MiddleBanner;
use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


class MiddleBannerRepository extends BaseRepository
{
    public $photo;

    public function __construct(MiddleBanner $middleBanner)
    {
        $this->middleBanner=$middleBanner;
    }


    public function getMiddleBannerPhoto(){
        return DB::table('middle_banners')->get();
    }


}
