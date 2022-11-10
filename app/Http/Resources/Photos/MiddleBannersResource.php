<?php

namespace App\Http\Resources\Photos;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class MiddleBannersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $middleBanner=[];

        $middleBanners = DB::table('middle_banners');
        if ($this->category_id == null){
            $middleBannersCategory = $middleBanners->where('category_id',null)->get();
        }
        else{
            $middleBannersCategory = $middleBanners->where('category_id',$this->category_id)->get();
        }


        foreach ($middleBannersCategory as $middleBanners) {

            $middleBanner[$middleBanners->id] = [
                'id'    => $middleBanners->id,
                'category_id'  => $middleBanners->category_id,
                'title' => $middleBanners->title,
                'banner' => $middleBanners->banner,
            ];
        }





        return [
            "id" => $this->id,
            'banner'=>$this->banner,
            'place'=>$this->place,
            'middleBanner'=>$middleBanner,
        ];
    }
}
