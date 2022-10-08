<?php

namespace App\Http\Livewire\Admin\PendingProduct;

use Livewire\Component;

class PendingProductDetailsComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.pending-product.pending-product-details-component')->layout('livewire.admin.layouts.base');
    }
}
