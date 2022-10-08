<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 6/29/2022
 */


namespace App\Http\Resources\WishList;

use App\Http\Resources\CategoryProdcut\CategoryProductResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\User\UserResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class WishListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = $this->product;
        if (isset($product)) {
            $product->setAttribute('wishlists_count', 1);
        }
        $product = new CategoryProductResource($product);

        return [
            'id'           => $this->id,
            'user_id'      => $this->user_id,
            //"product"      =>  isset($this->product_id) ? new CategoryProductResource(Product::find($this->product_id)): null,
            "product"      => new CategoryProductResource($this->product),
            'heart'        => $this->heart,
            'device_token' => $this->device_token,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
