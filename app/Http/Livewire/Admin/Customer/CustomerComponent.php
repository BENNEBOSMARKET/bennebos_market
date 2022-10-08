<?php

namespace App\Http\Livewire\Admin\Customer;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;

class CustomerComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $customers = User::paginate($this->sortingValue);
        return view('livewire.admin.customer.customer-component', ['customers' => $customers])->layout('livewire.admin.layouts.base');
    }
}
