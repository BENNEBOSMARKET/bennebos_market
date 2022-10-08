<?php

namespace App\Http\Livewire\Customer\MyOrder;

use App\Models\Order;
use Livewire\Component;

class OrderStatusComponent extends Component
{
    public $orderCode;

    public function mount($order_code)
    {
        $this->orderCode = $order_code;

        
    }

    public function render()
    {
        $order = Order::where('code', $this->orderCode)->first();

        return view('livewire.customer.my-order.order-status-component', ['order'=>$order])->layout('livewire.layouts.base');
    }
}
