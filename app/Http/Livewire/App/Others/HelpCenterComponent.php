<?php

namespace App\Http\Livewire\App\Others;

use Livewire\Component;

class HelpCenterComponent extends Component
{
    public function render()
    {
        return view('livewire.app.others.help-center-component')->layout('livewire.layouts.base');
    }
}
