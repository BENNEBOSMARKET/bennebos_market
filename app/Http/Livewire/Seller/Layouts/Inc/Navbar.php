<?php

namespace App\Http\Livewire\Seller\Layouts\Inc;

use App\Models\BusinessSetting;
use App\Models\Order;
use App\Models\SellerWallet;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Navbar extends Component
{
    public $point = 0, $amount = 0;

    public function reedemPoint()
    {
        $this->validate([
            'point'=>'required',
        ]);

        $totalPoints = DB::table('seller_wallets')->where('seller_id', authSeller()->id)->first()->points;
        
        if($this->point > $totalPoints){
            $this->dispatchBrowserEvent('error', ['message'=>'Not enough points']);
        }
        else{
            $minRedeem = BusinessSetting::find(1)->min_redeem;
            if($this->point >= $minRedeem){
                $wallet = SellerWallet::where('seller_id', authSeller()->id)->first();
                $wallet->points -= $this->point;
                $wallet->amount += $this->amount;
                $wallet->save();

                

                $this->dispatchBrowserEvent('success', ['message'=>'Point redeemed successfully']);
                $this->dispatchBrowserEvent('closeModal');
            }
            else{
                $this->dispatchBrowserEvent('error', ['message'=>'Min redeem point is 50']);
            }
        }

    }

    public function calculate()
    {
        $pointValue = BusinessSetting::find(1)->point_value;

        $this->amount = $this->point*$pointValue;
        
    }
        

    public function render()
    {
        $authId= authSeller()->id;
        $orders = Order::where('seller_id', $authId)->where('delivery_status', 'Pending')->get();
        $notifications = DB::table('notifications')->where('user_type', 'seller')
            ->where('user_id', $authId)->get();
        $totalPoints = DB::table('seller_wallets')->where('seller_id', $authId)->first()->points;

        return view('livewire.seller.layouts.inc.navbar', ['orders'=>$orders, 'totalPoints'=>$totalPoints, 'notifications'=>$notifications]);
    }
}
