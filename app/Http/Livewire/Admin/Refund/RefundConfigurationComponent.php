<?php

namespace App\Http\Livewire\Admin\Refund;

use App\Models\BusinessSetting;
use Livewire\Component;

class RefundConfigurationComponent extends Component
{
    public $refund_time;

    public function mount()
    {
        $data = BusinessSetting::find(1);
        $this->refund_time = $data->refund_time;
    }

    public function store()
    {
        $getData = BusinessSetting::find(1);

        if($getData){
            $data = $getData;
        }
        else{
            $data = new BusinessSetting();
        }
        
        $data->refund_time = $this->refund_time;
        $data->save();

        $this->dispatchBrowserEvent('success',['message'=>'Setting updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.refund.refund-configuration-component')->layout('livewire.admin.layouts.base');
    }
}
