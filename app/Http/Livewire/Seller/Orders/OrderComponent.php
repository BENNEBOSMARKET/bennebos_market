<?php

namespace App\Http\Livewire\Seller\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;
    public $sortStatus;

    public function render()
    {
        $orders = Order::where('id', '!=', '');

        if($this->sortStatus != ''){
            $orders = $orders->where('delivery_status', $this->sortStatus);
        }

        $orders = $orders->where('seller_id', authSeller()->id)->orderBy('created_at', 'DESC')->paginate(15);

        return view('livewire.seller.orders.order-component', ['orders'=>$orders])->layout('livewire.seller.layouts.base');
    }
}
