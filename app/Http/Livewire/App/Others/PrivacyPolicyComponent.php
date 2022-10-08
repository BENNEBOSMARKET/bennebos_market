<?php

namespace App\Http\Livewire\App\Others;

use App\Models\PrivacyPolicy;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public function render()
    {
        $privacypolicy = PrivacyPolicy::orderBy('id', 'DESC')->first();
        return view('livewire.app.others.privacy-policy-component', ['privacypolicy'=>$privacypolicy])->layout('livewire.layouts.base');
    }
}
