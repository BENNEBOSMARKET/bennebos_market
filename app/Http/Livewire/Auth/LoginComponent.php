<?php

namespace App\Http\Livewire\Auth;

use App\Models\SettingFeatureActivation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function signIn()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $getUser = User::where('email', $this->email)->first();

        if ($getUser != '') {
            if (Hash::check($this->password, $getUser->password)) {
                Auth::attempt(['email' => $this->email, 'password' => $this->password]);

                $this->dispatchBrowserEvent('success', ['message' => 'Login Successful']);
                return redirect()->route('customer.home');
            } else {
                session()->flash('errorMessage', 'Invalid email or password');
            }
        } else {
            session()->flash('errorMessage', 'Invalid email or password');
        }
    }

    public function render()
    {
        $social = SettingFeatureActivation::find(1);

        return view('livewire.auth.login-component', ['social' => $social])->layout('livewire.layouts.base');
    }
}
