<?php

namespace App\Http\Livewire\Admin\Seller;

use App\Models\CommissionHistory;
use Livewire\Component;
use Livewire\WithPagination;

class SellerCommissionComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $commissions = CommissionHistory::paginate(15);
        return view('livewire.admin.seller.seller-commission-component', ['commissions'=>$commissions])->layout('livewire.admin.layouts.base');
    }
}
