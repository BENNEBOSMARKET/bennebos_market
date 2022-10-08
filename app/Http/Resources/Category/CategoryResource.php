<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\CategoryProdcut\CategoryProductCollection;
use App\Http\Resources\Slider\SliderCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories_table = DB::table('categories');
        $sub_categories = $categories_table->where('parent_id',$this->id)->get();
        $sub_sub_categories = $categories_table->whereIn('sub_parent_id',$sub_categories->pluck('id'))->get();
        $sub_categories = $sub_categories->where('sub_parent_id','0');

        $products = [];
        if (isset($this->products)) {
            $products = $this->products()
                ->withCount('wishlists')
                //->translate()
                //->SelectSome()
                ->where("products.status",1)
                ->orderBy('products.id', 'DESC')
                ->limit(10)
                ->get();
        }

        return [
            "id" => $this->id,
            "parent" => $this->parent_id != 0?new CategoryResource($categories_table->where('id',$this->parent_id)->first()):null,
            "sub_categoirs" => count($sub_categories)?new CategoryCollection($sub_categories) : [],
            "sub_sub_categoirs" => count($sub_sub_categories)?new CategoryCollection($sub_sub_categories) : [],
            "name" => $this->name,
            "slug" => $this->slug,
            "sliders" => isset($this->sliders)? new SliderCollection($this->sliders()->where('status',"1")->get()):[],
            "products" => isset($this->products)? new CategoryProductCollection($this->products()->where("products.status",1)->orderBy('products.id', 'DESC')->limit(10)->get()): [],
            "commision_rate" => $this->commision_rate,
            "banner" => $this->banner,
            "featured" => $this->featured,
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
        ];
    }
}
