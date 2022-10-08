<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            "user" => new UserResource($this->user),
            "rating" => $this->rating,
            "comment" => $this->comment,
            "image" => $this->image? url('uploads/reviews/'.$this->image): null,
            "status" => (bool)$this->status,
        ];
    }
}
