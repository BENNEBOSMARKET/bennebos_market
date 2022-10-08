<?php

namespace App\Http\Livewire\Admin\Payout;

use App\Models\Withdraw;
use Livewire\Component;

class PayoutRequestComponent extends Component
{
    public $sortingValue = 10, $searchTerm;

    public function publishStatus($id)
    {
        $getPament = Withdraw::where('id', $id)->first();

        if($getPament->status == 0){
            $getPament->status = 1;
            $getPament->save();
            $this->dispatchBrowserEvent('success', ['message'=>'Payment request approved!']);
        }
        else{
            $this->dispatchBrowserEvent('warning', ['message'=>'Can not chnage approve payment!']);
        }
    }

    public function render()
    {
        $paymentsRequest = Withdraw::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.payout.payout-request-component', ['paymentsRequest' => $paymentsRequest])->layout('livewire.admin.layouts.base');
    }
}
