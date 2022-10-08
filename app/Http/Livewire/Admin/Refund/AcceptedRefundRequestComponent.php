<?php

namespace App\Http\Livewire\Admin\Refund;

use App\Models\Refund;
use Livewire\Component;

class AcceptedRefundRequestComponent extends Component
{
    public $sortingValue;
    public function render()
    {
        $refunds = Refund::where('refund_status', 1)->paginate($this->sortingValue);
        return view('livewire.admin.refund.accepted-refund-request-component', ['refunds'=>$refunds])->layout('livewire.admin.layouts.base');
    }
}
