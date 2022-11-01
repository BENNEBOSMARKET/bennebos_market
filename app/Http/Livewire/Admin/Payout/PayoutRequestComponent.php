<?php

namespace App\Http\Livewire\Admin\Payout;

use App\Models\Withdraw;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PayoutRequestComponent extends Component
{    use WithPagination;
    use WithFileUploads;

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
        $paymentsRequest = Withdraw::where('amount', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('message', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.payout.payout-request-component', ['paymentsRequest' => $paymentsRequest])->layout('livewire.admin.layouts.base');
    }
}
