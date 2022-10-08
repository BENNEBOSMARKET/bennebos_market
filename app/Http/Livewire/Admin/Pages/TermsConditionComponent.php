<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\TermsConditions;
use Livewire\Component;

class TermsConditionComponent extends Component
{
    public $description;
    public function mount()
    {
        $termscondition = TermsConditions::where('id', 1)->first();
        if($termscondition != ''){
            $this->description = $termscondition->description;
        }
    }
    public function storeData()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $getData = TermsConditions::where('id', 1)->first();
        if($getData != ''){
            $termscondition = $getData;
        }else{
            $termscondition = new TermsConditions();
        }
        $termscondition->description = $this->description;

        $termscondition->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Terms & Conditions Updated Successfully']);
    }
    
    public function render()
    {
        return view('livewire.admin.pages.terms-condition-component')->layout('livewire.admin.layouts.base');
    }
}
