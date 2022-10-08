<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\AboutBennebos;
use Livewire\Component;

class AboutBennebosComponent extends Component
{
    public $description;
    public function mount()
    {
        $aboutbennebos = AboutBennebos::where('id', 1)->first();
        if($aboutbennebos != ''){
            $this->description = $aboutbennebos->description;
        }
    }
    public function storeData()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $getData = AboutBennebos::where('id', 1)->first();
        if($getData != ''){
            $aboutbennebos = $getData;
        }else{
            $aboutbennebos = new AboutBennebos();
        }
        $aboutbennebos->description = $this->description;

        $aboutbennebos->save();
        $this->dispatchBrowserEvent('success', ['message'=>'About Bennebos Market Content Updated Successfully']);
    }
    
    public function render()
    {
        return view('livewire.admin.pages.about-bennebos-component')->layout('livewire.admin.layouts.base');
    }
}
