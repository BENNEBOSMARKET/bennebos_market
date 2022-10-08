<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Http\Livewire\App\Others\PrivacyPolicyComponent as OthersPrivacyPolicyComponent;
use App\Models\PrivacyPolicy;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public $description;
    public function mount()
    {
        $privacypolicy = PrivacyPolicy::where('id', 1)->first();
        if($privacypolicy != ''){
            $this->description = $privacypolicy->description;
        }
    }
    public function storeData()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $getData = PrivacyPolicy::where('id', 1)->first();
        if($getData != ''){
            $privacypolicy = $getData;
        }else{
            $privacypolicy = new PrivacyPolicy();
        }
        $privacypolicy->description = $this->description;

        $privacypolicy->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Privacy Policy Updated Successfully']);
    }
    

    public function render()
    {
        return view('livewire.admin.pages.privacy-policy-component')->layout('livewire.admin.layouts.base');
    }
}
