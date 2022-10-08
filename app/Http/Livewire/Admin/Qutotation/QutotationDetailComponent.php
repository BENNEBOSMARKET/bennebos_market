<?php

namespace App\Http\Livewire\Admin\Qutotation;

use App\Models\Qutotation;
use Livewire\Component;

class QutotationDetailComponent extends Component
{
    public $quotation;

    public function mount($slug){
        $this->quotation = Qutotation::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.admin.qutotation.qutotation-detail-component')->layout('livewire.admin.layouts.base');
    }
}
