<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            "id" => $this->id,
            //"owner_id" => $this->seller->id,
            //"seller" => $this->seller,
            "user" => isset($this->user_id)? new UserResource(Auth::user()) :null,
            "product" =>  isset($this->product_id)? new ProductResource($this->product): null,
            "address_id" => $this->address_id,
            "price" => $this->price,
            "tax" => $this->tax,
            "shipping_cost" => $this->shipping_cost,
            "discount" => $this->discount,
            "coupon_code" => $this->coupon_code,
            "quantity" => $this->quantity,
            "color" => $this->product_color ? $this->product_color->name : '',
            "size" => $this->product_size ? $this->product_size->size : '',
            "status" => (bool)$this->status,
            "ip_address" => $this->ip_address,
        ];
    }
}
