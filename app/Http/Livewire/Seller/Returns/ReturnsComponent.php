<?php

namespace App\Http\Livewire\Seller\Returns;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Refund;
use Livewire\Component;
use Livewire\WithPagination;

class ReturnsComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public $refund_id;
    public $refund;

//    public function mount($refund_id)
//    {
//        $this->refund_id = $refund_id;
//        $this->refund = Refund::find($refund_id);
//    }

    public function render()
    {
        $orders = Order::select(
            'orders.*',
            'refunds.id as refund_id',
            'refunds.seller_approved',
            'refunds.admin_approved',
            'refunds.is_seen',
            'refunds.reason',
            'refunds.reject_reason'
        )->join('refunds', 'refunds.order_id', '=', 'orders.id')
        ->where('orders.seller_id', '=', auth()->guard('seller')->user()->id);

        $orders = $orders->paginate($this->sortingValue);

        return view('livewire.seller.refund.refund-component', ['orders' => $orders])->layout('livewire.seller.layouts.base');
    }


    public function acceptRefund($refund_id)
    {
        $refund = Refund::find($refund_id);
        $refund->seller_approved = 1;

        $refund->save();

        checkForBothApprove($refund_id);

        return redirect()->back();
    }


    public function reject($refund_id)
    {
        $refund = Refund::find($refund_id);
        $refund->seller_approved = 0;
        $refund->save();

        return redirect()->back();
    }
}
