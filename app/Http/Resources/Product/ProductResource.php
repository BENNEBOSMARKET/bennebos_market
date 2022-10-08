<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Review\ReviewCollection;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*$color_images = $this->color_images ? json_decode($this->color_images): [];
        array_walk($color_images,function(&$value, $key){$value = url("uploads/product/".$value);});
        */

        $gallary_images = $this->gallery_image? json_decode($this->gallery_image) : [];
        // array_walk($gallary_images,function(&$value, $key){$value = url("uploads/product/".$value);});

        // Handle Colors and sizes
        $colors = [];
        $sizes = [];
        if (isset($this->commonColors)) {
            foreach ($this->commonColors as $commonColor) {

                $colors[] = [
                    'id'    => $commonColor->id,
                    'name'  => $commonColor->name,
                    'image' => $commonColor->image,
                ];
            }
        }

        if (isset($this->commonSizes)) {
            foreach ($this->commonSizes as $commonSize) {

                $sizes[$commonSize->id] = [
                    'id' => $commonSize->id,
                    'size' => $commonSize->size,
                ];
            }
        }

        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "category" => $this->category,
            "brand" => $this->brand?new BrandResource($this->brand):null,
            "reviews" => $this->reviews?new ReviewCollection($this->reviews):null,
            "added_by" => $this->added_by,
            "unit" => $this->unit,
            "barcode" => $this->barcode,
            "refundable" => $this->refundable,
            "thumbnail" => $this->thumbnail,
            "gallery_images" => $gallary_images,
            "video" => $this->video? url($this->video) : null,

            "size_id" => $this->size_id,
            "color_id" => $this->color_id,
            "sizes" => $sizes,
            "colors" => $colors,

            /*"color_images" => $color_images,
            "color_titles" => json_decode($this->color_titles),
            "color_prices" => json_decode($this->color_prices),
            */
            "seller" => $this->seller,

            "price" => json_decode($this->unit_price),
            "has_discount" => (Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?true:false,
            "discount" =>(Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?$this->discount: null,
            "quantity" => $this->quantity,
            "sku" => $this->sku,
            "total_review" => $this->total_review,
            "avg_review" => $this->avg_review,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "featured" => (bool)$this->featured,
            "status" => (bool)$this->status,
            "is_favourite" => isset($this->wishlists_count) ? (bool)$this->wishlists_count : false,
        ];

    }
}
