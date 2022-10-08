<?php

namespace App\Http\Livewire\Admin\Sales\Seller;

use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use App\Models\SubOrder;
use App\Models\OrderDetails;
use App\Models\SubOrderItem;

class SellerOrderDetailsComponent extends Component
{
    public $inhouse_order_id, $subOrder, $order;
    public $payment_status, $delivery_status;

    public function mount($id){
        $this->order = Order::where('id', $id)->first();
        $this->inhouse_order_id = $id;

        $this->payment_status = $this->order->payment_status;
        $this->delivery_status = $this->order->delivery_status;
    }

    public function changePaymentStatus()
    {
        $order = Order::find($this->order->id);
        $order->payment_status = $this->payment_status;
        $order->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Order status updated successfully']);
    }

    public function changeDeliveryStatus()
    {
        $order = Order::find($this->order->id);
        $order->delivery_status = $this->delivery_status;
        if($this->delivery_status == 'delivered'){
            $order->delivery_date = Carbon::now();
        }

        $order->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Order status updated successfully']);
    }

    public function render()
    {
        $sellerOrderDetails = OrderDetails::where('order_id', $this->inhouse_order_id)->get();
        return view('livewire.admin.sales.seller.seller-order-details-component', ['sellerOrderDetails' => $sellerOrderDetails])->layout('livewire.admin.layouts.base');
    }
}
