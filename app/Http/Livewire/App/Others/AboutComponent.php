<?php

namespace App\Http\Livewire\App\Others;

use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        return view('livewire.app.others.about-component')->layout('livewire.layouts.base');
    }
}
