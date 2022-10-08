<?php

namespace App\Http\Livewire\Seller\Layouts\Inc;

use App\Models\Shop;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $shop = Shop::where('seller_id', authSeller()->id)->first();
        return view('livewire.seller.layouts.inc.sidebar', ['shop'=>$shop]);
    }
}
