<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\CategoryProdcut\CategoryProductCollection;
use App\Http\Resources\CategoryProdcut\CategoryProductResource;
use App\Http\Resources\Review\ReviewCollection;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        $sizesStatus=[];

        if (isset($this->statusesColor)) {
            if (isset($this->commonColors)) {
                foreach ($this->statusesColor as $statusColor) {
                    $images=Color::where('product_color_id',$statusColor->id)->first();
                    $s = false;
                    $image=null;

                    foreach ($this->commonColors as $commonColor) {
                        if ($commonColor->id == $statusColor->id) {
                            $image=$images->image;
                            $s = true;
                        }
                        $colors[$statusColor->id] = [
                            'id' => $statusColor->id,
                            'product_color_id' => $images->product_color_id,
                            'image' => $image,
                            'color' => $statusColor->color,
                            'status'=>$s
                        ];
                    }
                }
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
        if (isset($this->statuses)){
            if (isset($this->commonSizes)) {

                foreach ($this->statuses as $status){
                    $s=false;
                    foreach ($this->commonSizes as $commonSize) {

                            if ($commonSize->id == $status->id ){

                                $s=true;
                            }
                    }


                                $sizesStatus[$status->id] = [
                                    'id' => $status->id,
                                    'size' => $status->size,
                                    'status'=>$s

                                ];



                }

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
            "all-sizes"=>$sizesStatus,
            "colors" => $colors,

            /*"color_images" => $color_images,
            "color_titles" => json_decode($this->color_titles),
            "color_prices" => json_decode($this->color_prices),
            */
            "seller" => $this->seller,
            "seller_address" => shop($this->user_id) ? shop($this->user_id)->address . " " .shop($this->user_id)->state_name ." ".shop($this->user_id)->country_name : null,
            "seller_country" => shop($this->user_id) ?shop($this->user_id)->country_name : null,
            "seller_city_name" => shop($this->user_id) ?shop($this->user_id)->state_name : null,
            "seller_county_name" => shop($this->user_id) ?shop($this->user_id)->county_name : null,
            
            "seller_country_flag" => shop($this->user_id) ? shop($this->user_id)->country_flag : null,
            "supplier_products" => new CategoryProductCollection(Product::where("user_id",$this->user_id)->where("id" ,"!=",$this->id)->take(8)->get()),
            "popular_products" => new CategoryProductCollection(Product::where('products.status', 1)->orderBy('products.total_review', 'DESC')->take('7')->get()),
            "similar_products" => new CategoryProductCollection(Product::where('products.status', 1)->where('products.category_id', $this->category_id)->where('products.id', '!=', $this->id)->take('8')->get()),
            "price" => json_decode($this->unit_price),
            "has_discount" => (Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?true:false,
            "discount" =>(Carbon::now() >= $this->discount_date_from && Carbon::now() <= $this->discount_date_to)?$this->discount: null,
            "quantity" => $this->quantity,
            "sku" => $this->sku,
            "shipping" => $this->shipping,
            "total_review" => $this->total_review,
            "avg_review" => $this->avg_review,
            "description" => $this->description,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "guarantee" => $this->guarantee,
            "featured" => (bool)$this->featured,
            "status" => (bool)$this->status,
            "is_favourite" => isset($this->wishlists_count) ? (bool)$this->wishlists_count : false,
        ];

    }
}
