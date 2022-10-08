<?php

namespace App\Http\Livewire\Seller;

use App\Models\Order;
use App\Models\Product;
use App\Models\SellerWallet;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $totalOrders, $totalProduct, $totalEarnings, $totalCustomer, $totalSell;

    public function errorMsg()
    {
        $this->dispatchBrowserEvent('error', ['message'=>'You have already applied for verification.']);
    }

    public function render()
    {
        $authID = authSeller()->id;
        $this->totalProduct = Product::where('user_id', $authID)->count();
        $this->totalEarnings = Order::where('seller_id', $authID)->where('delivery_status', 'delivered')->get()->sum('grand_total');
        $this->totalOrders = Order::where('seller_id', $authID)->count();
        $this->totalSell = Order::where('seller_id', $authID)->where('delivery_status', 'delivered')->count();

        $this->pendingOrders = Order::where('seller_id', $authID)->where('delivery_status', '!=', 'delivered')->count();
        $this->cancelledOrders = Order::where('seller_id', $authID)->where('delivery_status', 'cancelled')->count();

        return view('livewire.seller.dashboard-component')->layout('livewire.seller.layouts.base');
    }
}
