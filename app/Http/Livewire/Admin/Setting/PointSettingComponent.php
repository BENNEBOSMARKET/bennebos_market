<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\BusinessSetting;
use Livewire\Component;

class PointSettingComponent extends Component
{
    public $seller_point, $customer_point, $point_value, $min_point;

    public function mount()
    {
        $getData = BusinessSetting::find(1);
        $this->seller_point = $getData->seller_order_point;
        $this->customer_point = $getData->customer_order_point;
        $this->point_value = $getData->point_value;
        $this->min_point = $getData->min_redeem;
    }


    public function storeData()
    {
        $this->validate([
            'seller_point'=>'required',
            'customer_point'=>'required',
        ]);

        $getData = BusinessSetting::find(1);
        if($getData){
            $data = $getData;
        }
        else{
            $data = new BusinessSetting();
        }
        $data->seller_order_point = $this->seller_point;
        $data->customer_order_point = $this->customer_point;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Settings updated successfully']);
    }

    public function storePointValue()
    {
        $this->validate([
            'point_value'=>'required',
        ]);

        $getData = BusinessSetting::find(1);
        if($getData){
            $data = $getData;
        }
        else{
            $data = new BusinessSetting();
        }
        $data->point_value = $this->point_value;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Settings updated successfully']);
    }

    public function storeMinReedem()
    {
        $this->validate([
            'min_point'=>'required',
        ]);

        $getData = BusinessSetting::find(1);
        if($getData){
            $data = $getData;
        }
        else{
            $data = new BusinessSetting();
        }
        $data->min_redeem = $this->min_point;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Settings updated successfully']);
    }

    public function render()
    {
        return view('livewire.admin.setting.point-setting-component')->layout('livewire.admin.layouts.base');
    }
}
