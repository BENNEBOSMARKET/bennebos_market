<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class SellerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shop = DB::table('shops')->where('seller_id',$this->id)->first();
        $product=DB::table('products')->where('user_id',$this->id)->get();

        return [
            "id" => $this->id,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'avatar'=>$this->avatar,
            'referral_code'=>$this->referral_code,
            'Shop'=>$shop,
            'product'=>$product,
        ];
    }
}
