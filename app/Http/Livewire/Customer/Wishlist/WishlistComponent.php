<?php

namespace App\Http\Livewire\Customer\Wishlist;

use App\Models\WishList;
use Livewire\Component;
use Livewire\WithPagination;

class WishlistComponent extends Component
{
    use WithPagination;
    public $sortByPrice;

    public function deleteFromWishList($id)
    {
        $wishlist = WishList::where('id', $id)->first();
        $wishlist->delete();

        $this->dispatchBrowserEvent('error', ['message'=>'Product removed from wishlist']);
    }

    public function render()
    {
        $wishlist = WishList::select('wish_lists.*')->join('products', 'wish_lists.product_id', '=', 'products.id');
        if($this->sortByPrice == 'low_to_high'){
            $wishlist = $wishlist->orderBy('products.unit_price', 'ASC');
        }
        if($this->sortByPrice == 'high_to_low'){
            $wishlist = $wishlist->orderBy('products.unit_price', 'DESC');
        }

        $wishlists = $wishlist->where('wish_lists.user_id', user()->id)->paginate(5);

        return view('livewire.customer.wishlist.wishlist-component', ['wishlists'=>$wishlists])->layout('livewire.layouts.base');
    }
}
