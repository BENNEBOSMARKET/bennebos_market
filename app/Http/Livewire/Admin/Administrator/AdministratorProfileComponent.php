<?php

namespace App\Http\Livewire\Admin\Administrator;

use Livewire\Component;
use App\Models\Admin;

class AdministratorProfileComponent extends Component
{
    public $adminProfile;

    public function mount($id)
    {
        $this->adminProfile = Admin::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.admin.administrator.administrator-profile-component')->layout('livewire.admin.layouts.base');
    }
}
