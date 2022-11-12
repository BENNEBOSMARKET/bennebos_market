<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class HeaderCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sizesStatus=[];
        $categories_table = DB::table('categories');
        $sub_categories = $categories_table->where('parent_id',$this->id)->get();
        $sub_sub_categories = $categories_table->where('parent_id',$this->id)->whereIn('sub_parent_id',$sub_categories->pluck('id'))->get(['id','name','banner','image','icon']);
        $sub_categories=$sub_categories->where('sub_parent_id','0');
        if (isset($sub_categories)){
            foreach ($sub_categories as $sub_category){


                $sizesStatus[$sub_category->id] = [
                    'id' => $sub_category->id,
                    'banner' => $sub_category->banner,
                    "name"=>$sub_category->name,
                    "icon"=>$sub_category->icon,
                    'sub_parent_id'=>$sub_category->sub_parent_id,
                    "sub_sub_categoirs"=>count($sub_sub_categories)?$sub_sub_categories : []

                ];



            }
        }


        return [
            "id" => $this->id,
            "banner" => $this->banner,
            "name"=>$this->name,
            "icon"=>$this->icon,
            "sub_categoirs" => count($sizesStatus)?$sizesStatus : [],

            ];

    }
}
