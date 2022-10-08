<?php

namespace App\Http\Livewire\App\Category;

use App\Models\Seller;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class SellerPageComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $topSellers = Shop::where('status', 1)->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.app.category.seller-page-component', ['topSellers'=>$topSellers])->layout('livewire.layouts.base');
    }
}
