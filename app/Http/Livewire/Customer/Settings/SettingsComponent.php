<?php

namespace App\Http\Livewire\Customer\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SettingsComponent extends Component
{
    public $password, $confirm_password, $current_password;

    public function storeData()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ]);

        if(Hash::check($this->current_password, user()->password)){
            $setting = User::where('id', Auth::user()->id)->first();
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
        $setting = User::find(Auth::user()->id);
        return view('livewire.customer.settings.settings-component', ['setting' => $setting])->layout('livewire.layouts.base');
    }
}
