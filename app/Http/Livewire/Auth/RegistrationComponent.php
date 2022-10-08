<?php

namespace App\Http\Livewire\Auth;

use App\Models\SettingFeatureActivation;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegistrationComponent extends Component
{
    public $first_name, $last_name, $email, $password, $confirm_password;

    public function mount()
    {

    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'confirm_password'=>'required|min:8|same:password',
        ]);
    }

    public function signUp()
    {
        $this->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'confirm_password'=>'required|min:8|same:password',
        ],[
            'password.same'=>'The password confirmation does not match'
        ]);

        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->name = $this->first_name.' '.$this->last_name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();

        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->save();

        Auth::attempt(['email' => $this->email, 'password' => $this->password]);

        $this->dispatchBrowserEvent('success', ['message'=>'Registration Successfull']);
        return redirect()->route('customer.home');
    }

    public function render()
    {
        $social = SettingFeatureActivation::find(1);
        return view('livewire.auth.registration-component', ['social'=>$social])->layout('livewire.layouts.base');
    }
}
