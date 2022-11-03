<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shop = DB::table('shops');
        $countShop = $shop->where('country_id',$this->id)->count();
        return [
            "id" => $this->id,
            'name'=>$this->name,
            'sortname'=>$this->sortname,
            'countShop'=>$countShop,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
             ];
    }
}
