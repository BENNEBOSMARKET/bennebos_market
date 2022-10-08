<?php

namespace App\Http\Resources\CategoryProdcut;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            "id" => $this->id,
            "category_id" => $this->category_id?? null,
            "name" => $this->name,
            "thumbnail" => $this->thumbnail,
            "price" => json_decode($this->unit_price),
            "total_review" => $this->total_review,
            "has_discount" => (Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?true:false,
            "discount" =>(Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?$this->discount: null,
            "meta_title" => $this->meta_title,
            "featured" => (bool)$this->featured,
            "is_favourite" => isset($this->wishlists_count) ? (bool)$this->wishlists_count : false,
            "company_name" => $this->seller->name
        ];
    }
}
