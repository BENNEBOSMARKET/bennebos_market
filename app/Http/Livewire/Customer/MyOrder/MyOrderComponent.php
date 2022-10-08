<?php

namespace App\Http\Livewire\Customer\MyOrder;

use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class MyOrderComponent extends Component
{
    public $order_id, $sort_order;

    public function render()
    {
        $orders = Order::where('orders.id', '!=', '')
            ->select('orders.*', 'products.refundable', 'products.id as pid')
        ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
        ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
        ;

        if($this->sort_order != ''){
            if($this->sort_order == 1){
                $orders = $orders->orderBy('grand_total','DESC');
            }
            if($this->sort_order == 2){
                $orders = $orders->orderBy('grand_total','ASC');
            }
        }

        $orders = $orders->where('orders.user_id', user()->id)->orderBy('id', 'DESC')->get();
//dd($orders);
        return view('livewire.customer.my-order.my-order-component', ['orders' => $orders])->layout('livewire.layouts.base');
    }
}
