<?php

namespace App\Http\Livewire\Admin\Refund;

use App\Models\Refund;
use Livewire\Component;

class RejectedRefundRequestComponent extends Component
{
    public $sortingValue;

    public $reject_reason;

    public function viewReason($id)
    {
        $this->reject_reason = Refund::where('id', $id)->first()->reject_reason;
        
        $this->dispatchBrowserEvent('showReasonModal');
    }

    public function render()
    {
        $refunds = Refund::where('refund_status', 2)->paginate($this->sortingValue);
        return view('livewire.admin.refund.rejected-refund-request-component', ['refunds'=>$refunds])->layout('livewire.admin.layouts.base');
    }
}
