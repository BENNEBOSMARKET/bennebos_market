<?php

namespace App\Http\Livewire\Seller\Commission;

use App\Models\CommissionHistory;
use Livewire\Component;
use Livewire\WithPagination;

class CommissionHistoryComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $commissions = CommissionHistory::where('seller_id', authSeller()->id)->paginate(15);
        return view('livewire.seller.commission.commission-history-component', ['commissions'=>$commissions])->layout('livewire.seller.layouts.base');
    }
}
