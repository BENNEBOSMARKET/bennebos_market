<?php

namespace App\Http\Livewire\Seller\Orders;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Order;
use Livewire\Component;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\SellerWallet;
use App\Models\CommissionHistory;

class OrderDetailsComponent extends Component
{
    public $order_id, $delivery_order_id, $payment_status, $delivery_status;

    protected $listeners = ['deliveryConfirmed'=>'confirmDelivery', 'cancelConfirmed'=>'confirmCancellation'];

    public function mount($id)
    {
        $this->order_id = $id;
        $order = Order::where('id', $id)->first();
        $this->payment_status = $order->payment_status;
        $this->delivery_status = $order->delivery_status;
    }

    public function changePaymentStatus()
    {
        $order = Order::where('id', $this->order_id)->first();
        $order->payment_status = $this->payment_status;
        $order->save();

        if($this->payment_status == 'paid'){
            $myCat = Shop::where('seller_id', authSeller()->id)->first()->category_id;
            if($myCat != 0){
                $catComm = Category::where('id', $myCat)->first()->commision_rate;
            }
            else{
                $catComm = 0;
            }
            
            //commission
            $commission = ($order->grand_total*$catComm)/100;

            $earning = $order->grand_total-$commission;

            $wallet = SellerWallet::where('seller_id', authSeller()->id)->first();
            $wallet->amount += $earning;
            $wallet->save();

            $commissionHistory = new CommissionHistory();
            $commissionHistory->order_id = $order->id;
            $commissionHistory->seller_id = authSeller()->id;
            $commissionHistory->admin_commission = $commission;
            $commissionHistory->seller_earning = $earning;
            $commissionHistory->save();

            if($this->delivery_status == 'delivered'){
                addPoint($order->id, $order->seller_id, $order->user_id);
            }
            
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Order updated successfully']);
    }

    public function changeDeliveryStatus()
    {
        if($this->delivery_status == 'cancelled'){
            $this->dispatchBrowserEvent('show_delivery_cancel_confirmation');
        }
        else{
            $order = Order::where('id', $this->order_id)->first();
            $order->delivery_status = $this->delivery_status;
            if($this->delivery_status == 'delivered'){
                $order->delivery_date = Carbon::now();
            }
            $order->save();

            if($this->delivery_status == 'delivered' && $this->payment_status == 'paid'){
                addPoint($order->id, $order->seller_id, $order->user_id);
            }

            $this->dispatchBrowserEvent('success', ['message'=>'Order updated successfully']);
        }
    }

    public function confirmCancellation()
    {
        $order = Order::where('id', $this->order_id)->first();
        $order->delivery_status = 'cancelled';
        $order->save();
        
        $this->dispatchBrowserEvent('cancelled_message');
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();
        $orderItems = OrderDetails::where('order_id', $this->order_id)->get();

        return view('livewire.seller.orders.order-details-component', ['order'=>$order, 'orderItems'=>$orderItems])->layout('livewire.seller.layouts.base');
    }
}
