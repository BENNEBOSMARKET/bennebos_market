<?php

namespace App\Http\Livewire\App\Others;

use App\Models\TermsConditions;
use Livewire\Component;

class TermsConditionComponent extends Component
{
    public function render()
    {
        $termscondition = TermsConditions::orderBy('id', 'DESC')->first();
        return view('livewire.app.others.terms-condition-component', ['termscondition'=>$termscondition])->layout('livewire.layouts.base');
    }
}
