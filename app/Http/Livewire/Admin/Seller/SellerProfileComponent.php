<?php

namespace App\Http\Livewire\Admin\Seller;

use App\Models\Seller;
use Livewire\Component;

class SellerProfileComponent extends Component
{
    public $sellerProfile;

    public function mount($id)
    {
        $this->sellerProfile = Seller::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.admin.seller.seller-profile-component')->layout('livewire.admin.layouts.base');
    }
}
