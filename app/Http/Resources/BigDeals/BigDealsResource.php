<?php

namespace App\Http\Resources\BigDeals;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class BigDealsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $photo = DB::table('big_deals_photos');
        $seller=DB::table('sellers');
        $photoProduct = $photo->where('bigDealsPhoto_id', $this->id)->get();
        $sellerInfo=$seller->where('id',$this->seller_id)->first();
        return [
            "id" => $this->id,
            'name' => $this->name,
            'product_img' => $this->product_img,
            'category' => $this->category_id,
            'sub_category'=>$this->subCategory_id,
            'sub_sub_category'=>$this->sub_sub_category_id,
            'country'=>$this->country_id,
            'model_no'=>$this->model_no,
            'certification'=>$this->certification,
            'feet'=>$this->feet,
            'condition'=>$this->condition,
            'sku'=>$this->sku,
            'quantity'=>$this->quantity,
            'description'=>$this->description,
            'description_photo'=>$this->description_photo,
            'photoProduct'=>$photoProduct,
            'sellerInfo'=>$sellerInfo,

        ];
    }
}
