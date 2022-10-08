<?php

namespace App\Http\Livewire\Seller\Setting;

use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PasswordSettingComponent extends Component
{
    public $password, $confirm_password, $current_password;

    public function storeData()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ]);

        if(Hash::check($this->current_password, authSeller()->password)){
            $setting = Seller::where('id', authSeller()->id)->first();
            $setting->password = Hash::make($this->password);
            $setting->save();
            $this->dispatchBrowserEvent('success', ['message'=>'Password Updated Successfully']);

            $this->current_password = '';
            $this->password = '';
            $this->confirm_password = '';
        }else{
            $this->dispatchBrowserEvent('error', ['message'=>'Your Current Password is incorrect!']);
        }
    }

    public function render()
    {
        $setting = Seller::find(Auth::user()->id);
        return view('livewire.seller.setting.password-setting-component', ['setting'=>$setting])->layout('livewire.seller.layouts.base');
    }
}
