<?php
namespace App\Repositories\Photo;


use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Product\PhotosRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


class PhotosRepository extends BaseRepository
{
    public $photo;

    public function __construct(Photo $photo)
    {
       $this->photo=$photo;
    }
    public function getAllPhoto(){
        return DB::table('photos')->get();
    }


}
