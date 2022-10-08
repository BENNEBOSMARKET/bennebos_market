<?php

namespace App\Http\Livewire\Layouts\Inc;

use App\Models\WebsiteSetting;
use Livewire\Component;

class Footer extends Component
{
    public $setting;
    public function render()
    {
        $this->setting = WebsiteSetting::where('id', 1)->first();
        return view('livewire.layouts.inc.footer');
    }
}
