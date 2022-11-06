<?php

namespace App\Http\Livewire\Admin\Administrator;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Admin;

class AdministratorComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;

    public function render()
    {
        $administrator = Admin::where("role", "!=", "sub-admin")->where(function($query){
            $query->where('name', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('phone', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $this->searchTerm . '%');
        })->paginate($this->sortingValue);
        return view('livewire.admin.administrator.administrator-component', ['administrator' => $administrator])->layout('livewire.admin.layouts.base');
    }
}
