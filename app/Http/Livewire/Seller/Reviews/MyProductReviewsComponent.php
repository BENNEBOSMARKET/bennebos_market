<?php

namespace App\Http\Livewire\Seller\Reviews;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MyProductReviewsComponent extends Component
{
    use WithPagination;

    public function render()
    {
        //Get Products
        $products = DB::table('products')->where('user_id', authSeller()->id)->pluck("id")->toArray();

        $reviews = DB::table("reviews")->whereIn('product_id', $products)->orderBy('id','DESC')->paginate(15);

        return view('livewire.seller.reviews.my-product-reviews-component', ['reviews'=>$reviews])->layout('livewire.seller.layouts.base');
    }
}
