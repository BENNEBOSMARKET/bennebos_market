<?php

namespace App\Http\Livewire\Admin\Payout;

use App\Models\Payout;
use Livewire\Component;

class PayoutComponent extends Component
{
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $payments = Payout::orderBy('id', 'DESC')->where('status', 1)->paginate($this->sortingValue);
        return view('livewire.admin.payout.payout-component', ['payments' => $payments])->layout('livewire.admin.layouts.base');
    }
}
