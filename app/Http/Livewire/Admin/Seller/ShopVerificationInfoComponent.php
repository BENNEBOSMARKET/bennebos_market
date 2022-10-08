<?php

namespace App\Http\Livewire\Admin\Seller;

use App\Models\Notification;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Shop;
use App\Models\ShopVerification;
use Livewire\Component;

class ShopVerificationInfoComponent extends Component
{
    public $seller_id, $shop_id;

    protected $listeners = ['approveConfirmed'=>'approveApplication', 'rejectConfirmed'=>'rejectApplication'];

    public function mount($seller_id)
    {
        $seller = Seller::where('id', $seller_id)->first();
        $this->seller_id = $seller->id;
    }

    public function accept($id)
    {
        $this->shop_id = $id;
        $this->dispatchBrowserEvent('show-approve-confirmation');
    }

    public function approveApplication()
    {
        $shop = Shop::where('id', $this->shop_id)->first();
        $shop->verification_status = 1;
        $shop->save();

        $notification = new Notification();
        $notification->user_id = $shop->seller_id;
        $notification->user_type = 'seller';
        $notification->subject = 'Shop Verification';
        $notification->content = 'Your application for shop verification has been approved';
        $notification->save();

        $products = Product::where('user_id', $shop->seller_id)->get();
        foreach($products as $pdt){
            $product = Product::find($pdt->id);
            $product->status = 1;
            $product->save();
        }

        $this->dispatchBrowserEvent('applicationApproved');

        $this->shop_id = '';
    }

    public function reject($id)
    {
        $this->shop_id = $id;
        $this->dispatchBrowserEvent('show-reject-confirmation');
    }

    public function rejectApplication()
    {
        $shop = Shop::where('id', $this->shop_id)->first();
        $shop->verification_status = 2;
        $shop->save();

        $seller = Seller::where('id', $shop->seller_id)->first();
        $seller->application_status = 0;
        $seller->save();

        $notification = new Notification();
        $notification->user_id = $shop->seller_id;
        $notification->user_type = 'seller';
        $notification->subject = 'Shop Verification';
        $notification->content = 'Your application for shop verification has been rejected. Please submit real informations';
        $notification->save();

        
        $this->shop_id = '';

        session()->flash('applicationRejected');
        return redirect()->route('admin.sellerList');
    }



    public function render()
    {
        if(Seller::where('id', $this->seller_id)->first()->application_status == 1){
            $seller = Seller::where('id', $this->seller_id)->first();
            $shop = Shop::where('seller_id', $this->seller_id)->first();
            $verificationInfo = ShopVerification::where('seller_id', $this->seller_id)->orderBy('created_at', 'DESC')->first();

            return view('livewire.admin.seller.shop-verification-info-component', ['seller'=>$seller, 'shop'=>$shop, 'verificationInfo'=>$verificationInfo])->layout('livewire.admin.layouts.base');
        }
        else{
            abort(404);
        }
    }
}
