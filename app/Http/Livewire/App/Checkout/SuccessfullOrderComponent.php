<?php

namespace App\Http\Livewire\App\Checkout;

use Livewire\Component;

class SuccessfullOrderComponent extends Component
{
    public function render()
    {
        return view('livewire.app.checkout.successfull-order-component')->layout('livewire.layouts.base');
    }
}
