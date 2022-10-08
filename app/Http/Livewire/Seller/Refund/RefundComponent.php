<?php

namespace App\Http\Livewire\Seller\Refund;

use App\Models\Refund;
use Livewire\Component;

class RefundComponent extends Component
{
    public function approveRefund($id)
    {
        $req = Refund::find($id);
        $req->seller_approved = 1;
        $req->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Request approved successfully']);
    }

    public function rejectRefund($id)
    {
        $req = Refund::find($id);
        $req->seller_approved = 2;
        $req->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Request rejected successfully']);
    }

    public function render()
    {
        $requests = Refund::where('seller_id', authSeller()->id)->get();
        return view('livewire.seller.refund.refund-component', ['requests'=>$requests])->layout('livewire.seller.layouts.base');
    }
}
