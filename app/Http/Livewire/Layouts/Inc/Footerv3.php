<?php

namespace App\Http\Livewire\Layouts\Inc;

use Livewire\Component;
use App\Models\WebsiteSetting;

class Footerv3 extends Component
{
    public $setting;
    public function render()
    {
        $this->setting = WebsiteSetting::where('id', 1)->first();
        return view('livewire.layouts.inc.footerv3');
    }
}
