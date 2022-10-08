<?php

namespace App\Http\Livewire\Seller\Layouts;

use App\Models\WebsiteSetting;
use Livewire\Component;

class Base extends Component
{
    public $setting;
    public function render()
    {
        $this->setting = WebsiteSetting::where('id', 1)->first();
        return view('livewire.seller.layouts.base');
    }
}
