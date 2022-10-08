<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "logo" => url('uploads/brand/'.$this->logo),
            "meta_title" => $this->meta_title,
            "meta_description" => $this->meta_description,
            "top" => $this->top,
            "status" => (bool)$this->status,
       ];
    }
}
