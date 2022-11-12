<?php

namespace App\Http\Resources\Category;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class HeaderSubCategoryResource extends JsonResource
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
        $sub_sub=[];
        $categories_table = DB::table('categories');
        $sub_categories = $categories_table->where('parent_id',$this->id)->take(7)->get();
        foreach ($sub_categories as $sub_category){


            $sizesStatus[$sub_category->id] = [
                'id' => $sub_category->id,
                'banner' => $sub_category->banner,
                "name"=>$sub_category->name,
                "icon"=>$sub_category->icon,

            ];
            $sub_sub_categories = Category::where('parent_id',$this->id)->where('sub_parent_id',$sub_category->id)->get(['id','name','banner','image','icon']);

            foreach ($sub_sub_categories as $sub_sub_category){

                $sub_sub[$sub_sub_category->id]=[
                    'id' => $sub_sub_category->id,
                    'banner' => $sub_sub_category->banner,
                    "name"=>$sub_sub_category->name,
                    "icon"=>$sub_sub_category->icon,
                    'sub_parent_id'=>$sub_category->id,
                ];
            }



        }

        return [
            "id" => $this->id,
            "banner" => $this->banner,
            "name"=>$this->name,
            "icon"=>$this->icon,
            "sub_categoirs" => count($sizesStatus)?$sizesStatus : [],
            "sub_sub_categoirs" => count($sub_sub)?$sub_sub : [],

        ];

    }
}
