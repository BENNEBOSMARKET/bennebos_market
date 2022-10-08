<?php

namespace App\Http\Livewire\Customer\Inc;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.customer.inc.sidebar');
    }
}
