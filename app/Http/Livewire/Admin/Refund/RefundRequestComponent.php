<?php

namespace App\Http\Livewire\Admin\Refund;

use App\Models\Order;
use App\Models\User;
use App\Models\Refund;
use App\Models\Seller;
use App\Models\SellerWallet;
use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RefundRequestComponent extends Component
{
    use WithPagination;
    public $sortingValue;

    public $refund_reason, $reject_reason;

    public function viewReason($id)
    {
        $this->refund_reason = Refund::where('id', $id)->first()->reason;

        $refund = Refund::where('id', $id)->first();
        $refund->is_seen = 1;
        $refund->save();
        
        $this->dispatchBrowserEvent('showReasonModal');
    }

    public function acceptRefund($id)
    {
        $refund = Refund::find($id);
        if ($refund->seller_approved == 1) {
            $sellerWallet = SellerWallet::where('seller_id', $refund->seller_id)->first();
            if ($sellerWallet != null) {
                $sellerWallet->amount -= $refund->refund_amount;
            }
            $sellerWallet->save();
        }

        $wallet = Wallet::find($refund->user_id);
        $wallet->amount += $refund->refund_amount;
        $wallet->save();
        
        $refund->admin_approved = 1;
        $refund->refund_status = 1;
        $refund->save();

        $order = Order::find($refund->order_id);
        $order->order_status = 'accepted';
        $order->save();
        

        $this->dispatchBrowserEvent('success',['message'=>'Amount refunded successfully']);
    }

    public $reject_id, $order_code;
    public function rejectConfirmation($id)
    {
        $this->reject_id = $id;
        $this->order_code = order(Refund::find($id)->order_id)->code;

        $this->dispatchBrowserEvent('showRejectModel');
    }

    public function rejectRefund()
    {
        $this->validate([
            'reject_reason'=>'required',
        ]);

        $refund = Refund::find($this->reject_id);
        $refund->admin_approved = 2;
        $refund->refund_status = 2;
        $refund->reject_reason = $this->reject_reason;
        $refund->save();

        $order = Order::find($refund->order_id);
        $order->order_status = 'rejected';
        $order->save();

        $this->dispatchBrowserEvent('success',['message'=>'Refund rejected']);
        $this->dispatchBrowserEvent('closeModal');
    }


    public function render()
    {
        $refunds = Refund::where('refund_status', 0)->paginate($this->sortingValue);

        return view('livewire.admin.refund.refund-request-component', ['refunds'=>$refunds])->layout('livewire.admin.layouts.base');
    }
}
