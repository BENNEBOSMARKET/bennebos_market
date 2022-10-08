<?php

namespace App\Http\Livewire\Admin\Customer;

use Livewire\Component;
use App\Models\User;

class CustomerProfileComponent extends Component
{
    public $customerProfile;

    public function mount($id)
    {
        $this->customerProfile = User::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-profile-component')->layout('livewire.admin.layouts.base');
    }
}
