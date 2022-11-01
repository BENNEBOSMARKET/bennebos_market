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
        $payments = Payout::where('request_amount', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('message', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->where('status', 1)->paginate($this->sortingValue);
        return view('livewire.admin.payout.payout-component', ['payments' => $payments])->layout('livewire.admin.layouts.base');
    }
}
