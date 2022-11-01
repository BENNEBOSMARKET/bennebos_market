<?php

namespace App\Http\Livewire\Admin\Payout;

use App\Models\Payout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PayoutComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $payments = Payout::join('sellers','payouts.seller_id','=','sellers.id')->where('sellers.name', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('payouts.request_amount', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('payouts.message', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('payouts.created_at', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('payouts.id', 'DESC')->where('payouts.status', 1)->paginate($this->sortingValue);
        return view('livewire.admin.payout.payout-component', ['payments' => $payments])->layout('livewire.admin.layouts.base');
    }
}
