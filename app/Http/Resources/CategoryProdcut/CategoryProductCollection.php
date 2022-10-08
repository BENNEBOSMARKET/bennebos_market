<?php

namespace App\Http\Resources\CategoryProdcut;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [$this->collection];
        if(method_exists($this->resource, "total")){
            $pagination = [
                'pagination' => [
                    'total' =>  $this->total(),
                    'count' => $this->count(),
                    'per_page' => $this->perPage(),
                    'current_page' => $this->currentPage(),
                    'total_pages' => $this->lastPage(),
                    'next_page_url' => $this->nextPageUrl(),
                    'prev_page_url' => $this->previousPageUrl(),
                ]
            ];
            $data  = array_merge($data, $pagination);
            return $data;
        }

        return $data[0];
    }
}
