<?php

namespace App\Http\Resources\Photos;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PhotosColliction extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [$this->collection];
        $middleBanner=[];

        $middleBanners = DB::table('middle_banners');
        if ($data[0]->first()->category_id == null){
            $middleBannersCategory = $middleBanners->where('category_id',null)->get();
        }
        else{
            $middleBannersCategory = $middleBanners->where('category_id',$data[0]->first()->category_id)->get();
        }


        foreach ($middleBannersCategory as $middleBanners) {

            $middleBanner[$middleBanners->id] = [
                'id'    => $middleBanners->id,
                'category_id'  => $middleBanners->category_id,
                'title' => $middleBanners->title,
                'banner' => $middleBanners->banner,
            ];
        }

        $data  = array_merge(['photos'=>$data[0]], ['middleBanner'=>$middleBanner]);

        return $data;
    }
}
