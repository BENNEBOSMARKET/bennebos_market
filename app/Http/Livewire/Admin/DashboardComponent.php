<?php

namespace App\Http\Livewire\Admin;

use App\Models\CommissionHistory;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $products = Product::orderBy('id', 'DESC')->take(6)->get();
        $order = Order::all()->count();
        $inhouseOrderDetails = OrderDetails::all()->count();
        $orderToday = Order::whereDate('created_at', Carbon::today())->count();
        $adminCommission=CommissionHistory::all()->sum('admin_commission');
        $adminCommissionToday=CommissionHistory::whereDate('created_at', Carbon::today())->sum('admin_commission');
        $seller=Seller::all()->count();
        $sellerToday=Seller::whereDate('created_at', Carbon::today())->count();
        $Commissions=Seller::join('commission_histories','sellers.id','=','commission_histories.seller_id')->orderBy('commission_histories.created_at', 'desc')->take(6)->get();
        $productsTopRanked = Product::where('top_ranked',1)->take(6)->get();

        return view('livewire.admin.dashboard-component', ['productsTopRanked'=>$productsTopRanked,'Commissions'=>$Commissions,'inhouseOrderDetails'=>$inhouseOrderDetails,'products'=>$products ,'order'=>$order,'orderToday'=>$orderToday,'adminCommission'=>$adminCommission,'adminCommissionToday'=>$adminCommissionToday,'seller'=>$seller,'sellerToday'=>$sellerToday])->layout('livewire.admin.layouts.base');
    }
}
