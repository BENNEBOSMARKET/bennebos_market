<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class WishlistProductReport extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    public $product_wishlist_filter;

    public function render()
    {
        $productWlishlist = Product::where('id','!=','');
        if($this->product_wishlist_filter != ''){
            $productWlishlist = $productWlishlist->where('id', $this->product_wishlist_filter);
        }

        $products = $productWlishlist->where('name', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('added_by', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('slug', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.report.wishlist-product-report', ['products' => $products])->layout('livewire.admin.layouts.base');
    }
}
