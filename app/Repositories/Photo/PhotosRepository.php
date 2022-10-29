<?php
namespace App\Repositories\Photo;


use App\Models\Photo;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\DB;


class PhotosRepository extends BaseRepository
{
    public $photo;

    public function __construct(Photo $photo)
    {
       $this->photo=$photo;
    }

    public function getCategoryPhoto($id){
        return DB::table('photos')->where('category_id',$id)->where('home',null)->get();
    }
    public function getHomePhoto(){
        return DB::table('photos')->where('category_id',null)->where('home','home')->get();
    }


}
