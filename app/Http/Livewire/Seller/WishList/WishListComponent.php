<?php

namespace App\Http\Livewire\Seller\WishList;

use App\Models\Product;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class WishListComponent extends Component
{
    use WithPagination;
    public $searchTerm, $delete_id;

    public function render()
    {
        $products = collect([]);

        $wishlists = WishList::all();
        foreach($wishlists as $wishlist)
        {
            $product = Product::where('id', $wishlist->product_id)->first();
            if($product->user_id == authSeller()->id){
                if(!$products->contains('id', $product->id)){
                    $products->push($product);
                }
            }
        }
        
        $wishlistProducts = $products->paginate(10);

        return view('livewire.seller.wish-list.wish-list-component', ['wishlistProducts'=>$wishlistProducts])->layout('livewire.seller.layouts.base');
    }
}
