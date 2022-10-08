<?php

namespace App\Http\Livewire\Customer;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\WishList;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $total_wiselist = WishList::where('user_id', user()->id)->get()->count();
        $total_order = Order::where('user_id', user()->id)->get()->count();
        $total_earnpoint = Wallet::where('user_id', user()->id)->first()->points;

        $orderProduct = Order::orderBy('id', 'DESC')->where('user_id', user()->id)->limit(5)->get();
        
        return view('livewire.customer.dashboard-component', ['orderProduct' => $orderProduct, 'total_wiselist' => $total_wiselist, 'total_order' => $total_order, 'total_earnpoint' => $total_earnpoint])->layout('livewire.layouts.base');
    }
}
