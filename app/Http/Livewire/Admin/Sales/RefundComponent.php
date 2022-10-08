<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Order;
use App\Models\Refund;
use Livewire\Component;
use Livewire\WithPagination;

class RefundComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    protected $listeners = ['deleteConfirmed' => 'deleteData'];

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
        )
            ->join('refunds', 'refunds.order_id', '=', 'orders.id');

        $orders = $orders->paginate($this->sortingValue);

        //        dd($orders);

        return view('livewire.admin.sales.refund-component', ['orders' => $orders])->layout('livewire.admin.layouts.base');
    }


    public function acceptRefund($refund_id)
    {
        $refund = Refund::find($refund_id);
        $refund->admin_approved = 1;

        $refund->save();

        checkForBothApprove($refund_id);

        return redirect()->back();
    }


    public function reject($refund_id)
    {
        $refund = Refund::find($refund_id);
        $refund->admin_approved = 0;
        $refund->save();

        return redirect()->back();
    }
}
