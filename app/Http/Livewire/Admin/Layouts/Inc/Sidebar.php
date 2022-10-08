<?php

namespace App\Http\Livewire\Admin\Layouts\Inc;

use App\Models\WebsiteSetting;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.admin.layouts.inc.sidebar');
    }
}
